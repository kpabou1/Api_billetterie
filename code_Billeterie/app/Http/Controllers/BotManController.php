<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function($botman, $message) {

            if ($message == 'salut') {
                $this->askName($botman);


            }
            elseif ($message == '1') {
                $this->afficherDemandeParticulier($botman);
            }
            elseif ($message == '2') {
                $this->afficherDemandeProfessionnel($botman);
            }
            elseif ($message == '3') {
                $this->suivreDemande($botman);
            }


            else{
                $botman->reply("Commencez une conversation en disant Salut.");
            }

        });

        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    public function askName($botman)
    {
        $botman->ask('Bonjour! Quel est ton nom?', function(Answer $answer) {

            $name = $answer->getText();

            $this->say(
                'Ravi de vous rencontrer '.$name.
                "<br>".
                "<br>Je suis un bot qui vous permet de faire une demande d'immatriculation fiscal en tant que particulier ou professionnel et de suivre votre demande".
                "<br>".
                "<br>".
                "<br>Que voulez-vous faire?".
                "<br>".
                "<br>1- Faire une demande en tant que particulier".
                "<br>".
                "<br>2- Faire une demande en tant que professionnel".
                "<br>".
                "<br>3- Suivre une demande"

            );
        });
    }

//je fais une fonction qui va afficher comment faire une demande en tant que particulier

    public function afficherDemandeParticulier($botman)
    {
        $botman->ask(
            "Voici comment faire une demande en tant que particulier\n\n" .
            "<br>".
            "<br>".
            "<br>".
            " * Avoir un compte\n" .
            "<br>".
            "<br>".
            " * Lorsque vous êtes connecté, vous pouvez faire une demande en cliquant sur le bouton '<b>Faire une demande</b>'\n" .
            "<br>".
            "<br>".
            " * Vous serez redirigé vers un formulaire\n" .
            "<br>".
            "<br>".
            " * Remplissez le formulaire et validez votre demande\n" .
            "<br>".
            "<br>".
            " * Vous serez redirigé vers votre tableau de bord où vous pourrez suivre votre demande",
            function (Answer $answer) {

                // Le nom n'est pas utilisé dans votre exemple, vous pouvez le retirer si vous n'en avez pas besoin.

                $etapes =


                    "Que d'autre voulez-vous faire?\n\n" .
                    "<br>".
                    "<br>".
                    "1- Faire une demande en tant que particulier\n" .
                    "<br>".
                    "<br>".
                    "2- Faire une demande en tant que professionnel\n" .
                    "<br>".
                    "<br>".
                    "3- Suivre une demande";

                $this->say($etapes);
            }
        );
    }


public  function afficherDemandeProfessionnel($botman){
    $botman->ask(
        "Voici comment faire une demande en tant que professionnel\n\n" .
        "<br>".
        "<br>".
        "<br>".
        " * Avoir un compte\n" .
        "<br>".
        "<br>".
        " * Lorsque vous êtes connecté, vous pouvez faire une demande en cliquant sur le bouton '<b>Faire une demande en tant que Professionel</b>'\n" .
        "<br>".
        "<br>".
        " * Vous serez redirigé vers un formulaire\n" .
        "<br>".
        "<br>".
        " * Remplissez le formulaire et validez votre demande\n" .
        "<br>".
        "<br>".
        " * Vous serez redirigé vers votre tableau de bord où vous pourrez suivre votre demande",
        function (Answer $answer) {

            // Le nom n'est pas utilisé dans votre exemple, vous pouvez le retirer si vous n'en avez pas besoin.

            $etapes =
                "Que d'autre voulez-vous faire?\n\n" .
                "<br>".
                "<br>".
                "1- Faire une demande en tant que particulier\n" .
                "<br>".
                "<br>".
                "2- Faire une demande en tant que professionnel\n" .
                "<br>".
                "<br>".
                "3- Suivre une demande";
            $this->say($etapes);

}
    );
}
    public function suivreDemande($botman)
    {
        $botman->ask(
            "Voici comment suivre une demande\n\n" .
            "<br>".
            "<br>".
            "<br>".
            " * Avoir un compte\n" .
            "<br>".
            "<br>".
            " * lorsque vous êtes connecté, en étant sur votre tableau de bord, vous verrez un tableau qui a pour titre <b>Liste de vos demandes</b>\n" .
            "<br>".
            "<br>".
            " * vous verrez la colonne <b>statut demande</b> qui vous permettra de voir l'état de votre demande\n" .
            "<br>".
            "<br>".
            " * Au cas où votre demande est rejetée, vous n'avez qu'à cliquer sur le bouton <b>rejetée</b> pour voir les raisons du rejet, et refaire une nouvelle demande" .
            "<br>".
            "<br>".
            " *Au cas où votre demande est validée, vous verrez votre numéro d'immatriculation fiscal",
            function (Answer $answer) {

                // Le nom n'est pas utilisé dans votre exemple, vous pouvez le retirer si vous n'en avez pas besoin.

                $etapes =
                    "Que d'autre voulez-vous faire?\n\n" .
                    "<br>".
                    "<br>".
                    "1- Faire une demande en tant que particulier\n" .
                    "<br>".
                    "<br>".
                    "2- Faire une demande en tant que professionnel\n" .
                    "<br>".
                    "<br>".
                    "3- Suivre une demande";
                $this->say($etapes);
            }
        );
    }
    /*

    Pour faire une demande et avoir un numéro d'immatriculation fiscal en tant que particulier, il faut :

     - avoir un compte
     - lorsque vous êtes connecté, vous pouvez faire une demande en cliquant sur le bouton "Faire une demande"
     - vous serez redirigé vers un formulaire
     - remplissez le formulaire et validez votre demande
     - vous serrez redirigé vers votre tableau de bord ou vous pourrez suivre votre demande

    **********************************************************************************************************************
      -  Pour suivre une demande, il faut :
         - avoir un compte
         - lorsque vous êtes connecté, en étant sur votre tableau de bord, vous verrez un tableau qui a pour titre "Liste de vos demandes"
         - vous verrez la colonne "statut demande" qui vous permettra de voir l'état de votre demande
         - Au cas où votre demande est rejetée, vous n'avez qu'à cliquer sur le bouton "rejetée" pour voir les raisons du rejet, et refaire une nouvelle demande
         - Au cas où votre demande est validée, vous verrez votre numéro d'immatriculation fiscal

    ***********************************************************************************************************************
     * Pour faire une demande et avoir un numéro d'immatriculation fiscal en tant que professionnel, il faut :
     * - avoir un compte
     * - lorsque vous êtes connecté, vous pouvez faire une demande en cliquant sur le bouton "Faire une demande en tant que Professionel
     * - vous serez redirigé vers un formulaire
     * - remplissez le formulaire et validez votre demande
     * - vous serrez redirigé vers votre tableau de bord ou vous pourrez suivre votre demande


     */
}
