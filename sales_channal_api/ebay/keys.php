<?php
    //show all errors - useful whilst developing
    error_reporting(E_ALL);

    // these keys can be obtained by registering at http://developer.ebay.com
    
    $production         = true;   // toggle to true if going against production
    $compatabilityLevel = 515;    // eBay API version
    
    if ($production) {
        $devID = '8c9eb70c-83cd-431f-87ae-616a6dce2661';   // these prod keys are different from sandbox keys
        $appID = 'AnthonyE-1b20-4060-8a48-a07dedd38654';
        $certID = '1eb4dc48-54f0-40b9-9c80-1df14efd522c';
        //set the Server to use (Sandbox or Production)
        $serverUrl = 'https://api.ebay.com/ws/api.dll';      // server URL different for prod and sandbox
        //the token representing the eBay user to assign the call with
		//$userToken = 'AgAAAA**AQAAAA**aAAAAA**F7tCVQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AEkYOgDpGDqQWdj6x9nY+seQ**CIoCAA**AAMAAA**DPrTROGqgDteRchjtZ5lM2fADhq1sSbUL38FduVVaFsUVhjCPVJbS0xtsRggag1PgZQswezQiysemSGkMytVLuoA5ZmIs4oGhx/WPAbWqQB4mceHaYfJFJh6ptXdYXuWJ9SxEX7bT3zqzRPlaXTXpDhEaBbqYwoSSnLI/kiVk4Jo4hILu77TEThs+Qe7ju3t4A5psRXXCRR0o7yKms8ZTtgyQVcSWHN9o86+miRk4czUfTEuMIUBwxCYN7Af019EpLGPB1S3sV6PBculizJO7oIouxXhEDpHLjPDQ0M+8ZiBrz+KRtrHhogZdvaJJ2E/kIjTHMBqum2omenYlI0ePd+Wvnrj+IS47OATCu+z5dq8Zh1RSdjdqmnGfFi/UxkislBSJjTQmmxfUjKu/4WRpCW1A0NwA8u8HYrCyd8YHElNp6xOmrGHo15wC3MkfQqbNuQsoHzWYQ17LEgifz9Yb/i4R4GZUyvvFILmuyICamMeKN0OFiX/fT/lK1jjowEr+KK8RiitVerMqiMO7c4Ij3pluMzQE+Zu/jmBX4QDrwDo145yOgraIHbwFM1s0MTSQAgEGb7KEB4oxQqN7HThQ4tudJeIqjehkZRNXM4hNJjKQXnktjL5sMKGtxgAKIMuZqsh0kcmKVI6MVT7tFO/SJOyXXxFvUhw8N1P7I/P08spx7LLWzCHw2ltI6H+kccgEKda/BGyEOm5kYMwVq/8/1KdBLi3tVO4a5O40dhbWWlyeYUvrfwqye+kXX6KNSA0';
		$userToken = 'AgAAAA**AQAAAA**aAAAAA**6qwhVQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wDkoapAJKHpg6dj6x9nY+seQ**CIoCAA**AAMAAA**v+be+VJz7nZz7HiIG6jKgOF6kBa2vo8Y2CcM8nkecV8CQs9D+gf4MkbBgCCJ/cYCriix4eu/GNJAeKxUehB7rU/v1YaAgPTjuYLdFaNhEgDHsA7pFjUw1teLUc6mo/ZgUzS7PhjLWxsf1zJot69MyyZtSP3TxPis6Gwc/x4CzTuzGI6JSxxy4D5TLGP4C8wuJt/KJoZ8rhdiGx7PLn76HwVyf56kiA/PdxOEU7vBQv60G8dGNSZW9GNfO+rCNJj9jM0NikXdgux8rTz2qSF3IYRZSWyWQ6Qc7yVJnShl2iPKr7NHVpTcHdVhgNzQpjyPI2paR+7gMxHr2jRflPKyJtrWR5LRAVlUgMz4iz3ctRqCZep4mVhLXWz71F9l7DYwXC+HqvoVqNb2qKAk496U9GnPlpTYxof5FlnJM5bskxri9JrhbGSdOv/4kV/E1PKytH4pSs5Zw22wVBGQaGcXxmipJwWLC3sERhncyWP4jWdIgLq5MW4U6yN+rxmQ91n4NUbiIz/gOq7x8l9bwgivywCkXlwZlY3nxCiT4lnl5p4xuxvAzvBOQhGnrtJ9fl1BO5+Zljbb4jyjm413PPRBz9DUlGsxFgJan+00PU8nDZ3QDiMg7RiPWCIZ+QJC98hPKR+YFlsjKVa0julIjpYHsKK0YsNkbj21lXm7aVRVPaDCoYL11GcbviA0qWSigpFhGLXeZOQ1EnfUNK8R6DlH3HyTAk4SzERQcsjY4E6l8M/vSLxMXsXnVXoyYEEtRiQq';
		//$paypal = "eplatinumsales@gmail.com";
		$paypal = "antbusk@yahoo.com";
	} else {  
        // sandbox (test) environment
        $devID = '8c9eb70c-83cd-431f-87ae-616a6dce2661';         // insert your devID for sandbox
        $appID = 'AnthonyE-2eda-4a15-aca2-a78d4cd22c88';   // different from prod keys
        $certID = '2f34fee7-02d1-470a-aff4-595bd9f507ad';  // need three 'keys' and one token
        //set the Server to use (Sandbox or Production)
        $serverUrl = 'https://api.sandbox.ebay.com/ws/api.dll';
        // the token representing the eBay user to assign the call with
        // this token is a long string - don't insert new lines - different from prod token
        $userToken = 'AgAAAA**AQAAAA**aAAAAA**Et5KVA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhDJmCowqdj6x9nY+seQ**lxYDAA**AAMAAA**EGXiaOBRd+bFneEPvaUDR4h6nYdi6HDn9Aq+fGqGY3Nmjr04rjzTwa0Nns9kHWTlz0kZ3yZLQcS9zQQ95rpPDs09bSrZLALWeEN/hBCAfe61PNwjWl0lA58c4UiYcHr8cW7g8eHzHvR0dZiLKH8J2zrrAzn5TVL13pR4dJOJrtkG/K5Yl3bS7xdHOnzuADoBgjxAKXxLx7T6nkozU14ohGc088HZGhgP/d9YQnkhU9tIdoaeBfkulGsBMP583VWWZs5CgO+AkD5wdFGbRbTvjoNH50d9NB8zxHlahlKFMSxXvNE69HR8s02Coz+LyWv7v59Gfcvw3M/1ATQs4o55UObAAy277oJvH3+SXC0oWQ9lBh4CN4mQ+NKjvn6AJAlDis73F7o8NgoFjT1S/zNHTcXP9HjjglsLhhmHgF6WDu7hX3p1v99XypwcKgxrRTgjpUvpmrLPfDd+7A1QKDgQJPXnyoXMD72RU2LyuBuHwTqs6UL60lQQKgbc5qeNAmv+0I0ea7M3llMUl3yFdveko5o9zK/bmVIP3wioJHDmZWBmYVoZ7/xQciPj/17/FsEdwH2CmRJnHyP2Lt0H3FjR/2ftUFZHZn5GxHDQoKptOML86DmoR9AV9z1oXg4o/SzqggjRCjLc44Qn1Ik5HbQv9SK5TO7gkHHlIr3VJuCw2uG8MVqlMsXI3TTGMC54WrEjK2kqU+FhHhMRf2MFb5iIBMU8m0VLRsi37Ovdk8/2TBieJ8QVvYUbJPmW06TVGAzl';                 
		$paypal = "antbusk-facilitator@yahoo.com";
   }
    
    
?>