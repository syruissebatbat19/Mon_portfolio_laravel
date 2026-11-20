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
            "Mobile et autres" => ["WinDev Mobile", "WinDev", "VBA", "Outils Microsoft", "Gestion de projets IT"],
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
        $data = $request->validate([
            "name" => ["required", "string", "max:100"],
            "email" => ["required", "email", "max:150"],
            "body" => ["required", "string", "max:2000"],
        ]);

        // Enregistrer le message dans la base de données.
        $message = Message::create($data);

        try {
            // Envoyer le mail de notification.
            Mail::to(config("mail.from.address"))
                ->send(new ContactMessage($message));

            return redirect()->back()
                ->withFragment("contact")
                ->with("sent", "Message envoyé. Je vous réponds rapidement.");

        } catch (\Throwable $e) {

            // Enregistrer l'erreur dans les logs Laravel.
            Log::error("Échec de l'envoi du mail de contact", [
                "error" => $e->getMessage(),
            ]);

            return redirect()->back()
                ->withFragment("contact")
                ->with("error", "Votre message est enregistré, mais son envoi par email a échoué. Veuillez réessayer plus tard.");
        }
    }
}