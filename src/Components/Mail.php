<?php

namespace WordPlate\Components;

use PHPMailer;

/**
 * This is the mail component
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Mail extends Component
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->action->add('phpmailer_init', [$this, 'register']);
    }

    /**
     * @param \PHPMailer $mail
     *
     * @return \PHPMailer
     */
    protected function register(PHPMailer $mail) {
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = config('mail.host');
        $mail->Port = config('mail.port');
        $mail->Username = config('mail.username');
        $mail->Password = config('mail.password');
        $mail->From = config('mail.from.address');
        $mail->FromName = config('mail.from.name');

        return $mail;
    }
}
