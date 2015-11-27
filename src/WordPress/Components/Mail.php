<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\WordPress\Components;

use PHPMailer;

/**
 * This is the mail component.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
final class Mail extends Component
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function register()
    {
        if (config('mail.host') && config('mail.username') && config('mail.password')) {
            $this->action->add('phpmailer_init', [$this, 'mail']);
        }
    }

    /**
     * Register custom SMTP mailer.
     *
     * @param \PHPMailer $mail
     *
     * @return \PHPMailer
     */
    public function mail(PHPMailer $mail)
    {
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = config('mail.host');
        $mail->Port = config('mail.port');
        $mail->Username = config('mail.username');
        $mail->Password = config('mail.password');

        if (empty($mail->From)) {
            $mail->From = config('mail.from.address');
        }

        if (empty($mail->FromName)) {
            $mail->From = config('mail.from.name');
        }

        return $mail;
    }
}
