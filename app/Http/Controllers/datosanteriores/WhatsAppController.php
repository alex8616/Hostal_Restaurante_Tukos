<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function sendWhatsAppMessage()
    {
        /*// Tu número de teléfono de WhatsApp y el número de teléfono al que deseas enviar el mensaje
        $from = '+19793416235';
        $to = '+59179431192';

        // Credenciales de API de Twilio
        $account_sid = 'AC8d86c4d47ff1f1e4f7a1e3ab55ce0dcb';
        $auth_token = 'c214c3773d5cdf3d75c52bdb0919de03';

        // Crea una instancia del cliente Twilio
        $client = new Client($account_sid, $auth_token);

        // Envía el mensaje de WhatsApp utilizando el cliente Twilio
        $message = $client->messages->create(
            $to,
            array(
                'from' => $from,
                'body' => 'Este es un mensaje de prueba enviado desde mi aplicación Laravel a través de WhatsApp.'
            )
        );

        return response()->json(['message' => 'Mensaje enviado correctamente a través de WhatsApp.']);*/

        // Tu número de teléfono de WhatsApp y el número de teléfono al que deseas enviar el mensaje
        $from = 'whatsapp:+14155238886';
        $to = 'whatsapp:+59179431192';

        // Credenciales de API de Twilio
        $account_sid = 'AC8d86c4d47ff1f1e4f7a1e3ab55ce0dcb';
        $auth_token = 'c214c3773d5cdf3d75c52bdb0919de03';

        // Crea una instancia del cliente Twilio
        $client = new Client($account_sid, $auth_token);

        // Envía el mensaje de WhatsApp utilizando el cliente Twilio
        $message = $client->messages->create(
            $to,
            array(
                'from' => $from,
                'body' => 'Para solucionar este problema, asegúrate de que el número de teléfono al que estás intentando enviar el mensaje se haya registrado en el entorno de Sandbox de Twilio para WhatsApp. Para hacer esto, sigue estos pasos: '
            )
        );

        return response()->json(['message' => 'Mensaje enviado correctamente a través de WhatsApp.']);
    }
        
}
