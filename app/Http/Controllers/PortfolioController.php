<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use App\Models\Message;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PortfolioController extends Controller
{
    public function home()
    {
        $skills = [
            "Backend" => ["PHP (Laravel)", "Python (Django)", "Java", "C", "SQL"],
            "Frontend" => ["HTML", "CSS"],
            "Mobile et autres" => [
                "WinDev Mobile",
                "WinDev",
                "VBA",
                "Outils Microsoft",
                "Gestion de projets IT"
            ],
        ];

        return view("home", [
            "projects" => Project::orderBy("position")->get(),
            "skills" => $skills,
        ]);
    }

    public function show(Project $project)
    {
        return view("projects.show", compact("project"));
    }

    public function contact(Request $request)
    {
        // 1. Valider les données du formulaire.
        $data = $request->validate([
            "name" => ["required", "string", "max:100"],
            "email" => ["required", "email", "max:150"],
            "body" => ["required", "string", "max:2000"],
        ]);

        // 2. Enregistrer le message dans la base de données.
        $message = Message::create($data);

        // 3. Récupérer l'adresse qui doit recevoir les notifications.
        $recipient = config("mail.contact_to");

        // Vérifier que l'adresse de destination est configurée.
        if (empty($recipient)) {
            Log::error("L'adresse MAIL_CONTACT_TO n'est pas configurée.");

            return redirect()->back()
                ->withInput()
                ->withFragment("contact")
                ->with("error", "Votre message est enregistré, mais la configuration de l'envoi email est incomplète.");
        }

        try {
            // 4. Envoyer le mail de notification avec Resend.
            Mail::to($recipient)
                ->send(new ContactMessage($message));

            // 5. Confirmer l'envoi uniquement si aucune erreur n'est survenue.
            return redirect()->back()
                ->withFragment("contact")
                ->with("sent", "Message envoyé. Je vous réponds rapidement.");

        } catch (\Throwable $e) {

            // 6. Enregistrer les détails de l'erreur dans les logs.
            Log::error("Échec de l'envoi du mail de contact", [
                "error" => $e->getMessage(),
            ]);

            // Le message reste enregistré dans la base de données.
            return redirect()->back()
                ->withInput()
                ->withFragment("contact")
                ->with("error", "Votre message est enregistré, mais son envoi par email a échoué. Veuillez réessayer plus tard.");
        }
    }
}