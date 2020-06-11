<?php

namespace App\Controller;

use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrentDateController
{
    /**
     * jeśli zainstalujemy symfony require annotations, wtedy możemy ustawiać ściężkę tutaj zamiast w routingach
     * @Route(path="/index")
     * @return Response
     * @throws
    **/
    public function main(): Response
    {
        $currentDate = new DateTime(); //$currentDate jest obiektem klasy DateTime

        return new Response("<html><body>" . $currentDate->format(DATE_ATOM) . "</body>"); //dlatego trzeba go przerobić na stringa
    }
}
