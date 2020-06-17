<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrentDateController
{
    /**
     * jeśli zainstalujemy symfony require annotations, wtedy możemy ustawiać ściężkę tutaj zamiast w routingach
     * ścieżka będzie działać zarówna ta jak i ta w routes.yaml
     * @Route(path="/index", name="currentDate")
     * @return Response
     * @throws
    **/
    public function currentDate(): Response
    {
        $currentDate = new \DateTime(); //$currentDate jest obiektem klasy DateTime

        return new Response("<html><body>" . $currentDate->format(DATE_ATOM) . "</body></html>");
    }
}
