<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::updateOrCreate(["slug" => "auto-assurance-maladie"], [
            "title" => "Application d’auto-assurance maladie",
            "summary" => "Remboursement des frais de santé des agents de la SOTRA.",
            "description" => "Application réalisée pendant mon stage à la SOTRA Vridi (novembre 2025 - février 2026). Elle permet de gérer le remboursement des agents dans le cadre de l’auto-assurance maladie.\n\nJ’ai pris en charge toute la partie back-end : logique métier, base de données et traitement des demandes de remboursement.",
            "role" => "Développeur back-end",
            "technologies" => [],
            "position" => 1,
        ]);

        Project::updateOrCreate(["slug" => "reservation-tickets-bus"], [
            "title" => "Réservation de tickets de bus",
            "summary" => "Application de réservation de voyages pour le transport routier.",
            "description" => "Le passager réserve pour lui, pour plusieurs personnes ou pour un tiers, choisit ses sièges, paie en ligne, télécharge ses tickets et consulte son historique.\n\nL’administrateur de gare crée, modifie et supprime les voyages de sa gare, et vérifie les réservations.",
            "role" => "Développeur backend et mobile",
            "technologies" => ["Laravel", "Flutter", "SQL"],
            "position" => 2,
        ]);
    }
}
