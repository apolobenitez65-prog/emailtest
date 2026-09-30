<?php
//Parte 3
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestBrevoMail;

class MailTest extends TestCase
{
    public function test_formulario_mail_se_muestra_correctamente(): void
    {
        $response = $this->get('/mail');

        $response->assertStatus(200);
        $response->assertSee('Envío de correo');
        $response->assertSee('Correo destinatario');
        $response->assertSee('Asunto');
        $response->assertSee('Mensaje');
        $response->assertSee('Enviar correo');
    }
    //test 2
    public function test_campos_del_formulario_son_obligatorios(): void
    {
        $response = $this->post('/mail/enviar', []);

        $response->assertSessionHasErrors([
            'destinatario',
            'nombre',
            'asunto',
            'mensaje'
        ]);
    }
    //test 3
    public function test_destinatario_debe_ser_un_email_valido(): void
    {
        $response = $this->post('/mail/enviar', [
            'destinatario' => 'correo-invalido',
            'nombre' => 'Juan Pérez',
            'asunto' => 'Prueba',
            'mensaje' => 'Mensaje de prueba'
        ]);
        $response->assertSessionHasErrors('destinatario');
    }
    //test 4
    public function test_correo_se_envia_correctamente(): void
    {
        Mail::fake();
        $this->post('/mail/enviar', [
            'destinatario' => 'alumno@example.com',
            'nombre' => 'Juan Pérez',
            'asunto' => 'Trabajo Práctico',
            'mensaje' => 'Trabajo recibido correctamente.'
        ]);
        Mail::assertSent(TestBrevoMail::class);
    }
    //test 5
    public function test_correo_se_envia_al_destinatario_correcto(): void
    {
        Mail::fake();
        $this->post('/mail/enviar', [
            'destinatario' => 'alumno@example.com',
            'nombre' => 'Juan Pérez',
            'asunto' => 'Trabajo Práctico',
            'mensaje' => 'Su trabajo fue recibido.'
        ]);
        Mail::assertSent(
            TestBrevoMail::class,
            function ($mail) {
                return $mail->hasTo('alumno@example.com');
            }
        );
    }
    //test 6
    public function test_mailable_recibe_los_datos_correctos(): void
    {
        Mail::fake();
        $this->post('/mail/enviar', [
            'destinatario' => 'alumno@example.com',
            'nombre' => 'María López',
            'asunto' => 'Aviso importante',
            'mensaje' => 'La clase comienza a las 14 horas.'
        ]);
        Mail::assertSent(
            TestBrevoMail::class,
            function ($mail) {
                return
                    $mail->nombre === 'María López' &&
                    $mail->asunto === 'Aviso importante' &&
                    $mail->mensaje === 'La clase comienza a las 14
horas.';
            }
        );
    }
    //test 7
    public function
    test_no_se_envia_correo_si_los_datos_son_invalidos(): void
    {
        Mail::fake();
        $this->post('/mail/enviar', [
            'destinatario' => 'correo-invalido',
            'nombre' => '',
            'asunto' => '',
            'mensaje' => ''
        ]);
        Mail::assertNothingSent();
    }
}
