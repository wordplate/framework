<?php

namespace WordPlate\Tests;

// Adapted from https://github.com/php-enqueue/enqueue-dev/blob/master/pkg/test/RetryTrait.php
// (fixed typos, added sleep time)
trait RetryTrait
{
    public function runBare(): void
    {
        $e = null;
        $numberOfRetries = $this->getNumberOfRetries();
        $sleepTime = $this->getSleepTime();

        for ($i = 0; $i < $numberOfRetries; $i++) {
            try {
                parent::runBare();

                return;
            } catch (\PHPUnit_Framework_IncompleteTestError $e) {
                throw $e;
            } catch (\PHPUnit_Framework_SkippedTestError $e) {
                throw $e;
            } catch (\Throwable $e) {
                // last one thrown below
            } catch (\Exception $e) {
                // last one thrown below
            }

            usleep($sleepTime * 1000000);
        }
        if ($e) {
            throw $e;
        }
    }

    /**
     * @return int
     */
    private function getNumberOfRetries()
    {
        $numberOfRetries = 1;

        if (isset($annotations['class']['retry'][0])) {
            $numberOfRetries = $annotations['class']['retry'][0];
        }

        $annotations = $this->getAnnotations();

        if (isset($annotations['method']['retry'][0])) {
            $numberOfRetries = $annotations['method']['retry'][0];
        }

        if (false == is_numeric($numberOfRetries)) {
            throw new \LogicException(
                sprintf('The number of retries must be a number but got "%s"',
                var_export($numberOfRetries, true))
            );
        }

        $numberOfRetries = (int) $numberOfRetries;

        if ($numberOfRetries <= 0) {
            throw new \LogicException(
                sprintf(
                    'The number of retries must be > 0 but got "%s".',
                    $numberOfRetries
                )
            );
        }

        return $numberOfRetries;
    }

    /**
     * @return float
     */
    private function getSleepTime()
    {
        $sleepTime = 0;

        $annotations = $this->getAnnotations();

        if (isset($annotations['class']['sleep'][0])) {
            $sleepTime = $annotations['class']['sleep'][0];
        }

        if (isset($annotations['method']['sleep'][0])) {
            $sleepTime = $annotations['method']['sleep'][0];
        }

        if (false == is_numeric($sleepTime)) {
            throw new \LogicException(
                sprintf('The sleep time must be a number but got "%s"',
                var_export($sleepTime, true)
              )
            );
        }

        $sleepTime = (float) $sleepTime;

        if ($sleepTime < 0) {
            throw new \LogicException(
                sprintf(
                    'The sleep time must be a >= 0 but got "%s".', $sleepTime
                )
            );
        }

        return $sleepTime;
    }
}
