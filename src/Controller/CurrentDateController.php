<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrentDateController
{
    /**
     * jeśli zainstalujemy symfony require annotations, wtedy możemy ustawiać ściężkę tutaj zamiast w routingach
     * ścieżka będzie działać zarówna ta jak i ta w routes.yaml
     * @Route(path="/index", name="currentDate", methods={"GET"})
     * @return Response
     * @throws
     **/
    public function currentDate(): Response
    {
        $currentDate = new \DateTime(); //$currentDate jest obiektem klasy DateTime

        return $this->getDateResponse("Current date", $currentDate);
    }

    /**
     * @Route(path="/index/tomorrow", methods={"GET"})
     * @return Response
     * @throws \Exception
     */
    public function tomorrowDate(): Response
    {
        $tomorrow = new \DateTime();
        $tomorrow->add(new \DateInterval('P1D'));

        return $this->getDateResponse("Tomorrow day", $tomorrow);
    }

    private function getDateResponse(string $title, \DateTime $dateTime)
    {
        $format = $dateTime->format(DATE_ATOM);
        $html = <<< EOT
        <html>
            <body>
                <h1>$title</h1>
                <p>$format</p>
            </body>
        </html>
EOT;
        return new Response($html);
    }

}
