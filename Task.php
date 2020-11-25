<?php

class Task
{
    private const URL = 'http://192.168.88.239:8080/appendix_http/task_1.php';

    private function printResult($result)
    {
        file_put_contents('out.txt', var_export($result, true));
    }

    public function __invoke()
    {
        $curl = curl_init(self::URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);

        $result = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

        if ($code !== 200) {
            $this->printResult('Response code in not 200 (' . $code . '), ' . curl_error($curl));
        } else {
            $this->printResult($result);
        }

        curl_close($curl);
    }
}
