<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Components;

use PHPMailer;

/**
 * This is the mail component.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Mail extends AbstractComponent
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
     * Register custom SMTP mailer.
     *
     * @param \PHPMailer $mail
     *
     * @return \PHPMailer
     */
    public function register(PHPMailer $mail)
    {
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
