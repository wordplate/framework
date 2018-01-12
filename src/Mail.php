<?php

/*
* This file is part of WordPlate.
*
 * (c) Vincent Klaiber <hello@vinkla.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

declare(strict_types=1);

namespace WordPlate;

use PHPMailer;

/**
 * This is the mail class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
final class Mail
{
    /**
     * Run the mail helper.
     *
     * @return void
     */
    public function load(): void
    {
        // Load WordPress's action and filter helper functions.
        require_once ABSPATH.'wp-includes/plugin.php';

        // Add custom SMTP credentials.
        add_action('phpmailer_init', function (PHPMailer $mail) {
            $mail->IsSMTP();
            $mail->SMTPAuth = env('MAIL_USERNAME') && env('MAIL_PASSWORD');

            $mail->SMTPAutoTLS = false;
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');

            $mail->Host = env('MAIL_HOST');
            $mail->Port = env('MAIL_PORT', 587);
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');

            return $mail;
        });

        // Add filter for default mail from address, if defined.
        if (env('MAIL_FROM_ADDRESS')) {
            define('MAIL_FROM_ADDRESS', env('MAIL_FROM_ADDRESS'));

            add_filter('wp_mail_from', function () {
                return MAIL_FROM_ADDRESS;
            });
        }

        // Add filter for default mail from name, if defined.
        if (env('MAIL_FROM_NAME')) {
            define('MAIL_FROM_NAME', env('MAIL_FROM_NAME'));

            add_filter('wp_mail_from_name', function () {
                return MAIL_FROM_NAME;
            });
        }
    }
}
