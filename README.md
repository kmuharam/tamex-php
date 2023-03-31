<a name="readme-top"></a>

[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

<!-- PROJECT LOGO -->
<br />

<div align="center">
  <a href="https://github.com/kmuharam/tamex-php">
    <img src="docs/images/logo.png" alt="tamex-php" width="150" height="35">
  </a>

  <h3 align="center">TAMEX PHP</h3>

  <p align="center">
    <a href="https://www.tamex.com.sa" target="_blank">TAMEX</a> REST API integration for your <a href="https://php.net" target="_blank">PHP</a> application.
    <br />
    <a href="docs/TAMEX-API-2.7 .pdf"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/kmuharam/tamex-php">View Demo</a>
    ·
    <a href="https://github.com/kmuharam/tamex-php/issues">Report Bug</a>
    ·
    <a href="https://github.com/kmuharam/tamex-php/issues">Request Feature</a>
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
    </li>
    <li>
      <a href="#support">Support</a>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li>
      <a href="#usage">Usage</a>
      <ul>
        <li><a href="#quick-start">Quick start</a></li>
        <li><a href="#expected-responses">Expected responses</a></li>
      </ul>
    </li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## About The Project

This project is a PHP integration for the <a href="https://www.tamex.com.sa" target="_blank">TAMEX</a> v2 REST API.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- SUPPORT US -->

## Support

<a href="https://www.buymeacoffee.com/kmuharam" target="_blank">
  <img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="buy me a coffee" width="170" height="37">
</a>

<a href="https://paypal.me/moharrum?country.x=SA&locale.x=en_US" target="_blank">
  <img src="docs/images/paypal-donate.png" alt="buy me a coffee" width="170" height="37">
</a>

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->

## Getting Started

This package can be installed through Composer.

You can view and download <a href="docs/TAMEX-API-2.7 .pdf">TAMEX 2.7 API docs from here</a>.

### Prerequisites

Before you can start using this package, you need to contact [TAMEX](https://www.tamex.com.sa) sales to obtain `test` and `live` API keys.

### Installation

```sh
composer require kmuharam/tamex-php
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- USAGE EXAMPLES -->

## Usage

### Quick start

In the below code you find an example implementation of the three operations supported by the API.

```php

<?php

namespace MyAwesomeApp\Shipments\Services;

use Kmuharam\Tamex\Requests\CreateShipmentRequest;
use Kmuharam\Tamex\Requests\PrintWaybillRequest;
use Kmuharam\Tamex\Requests\ShipmentStatusRequest;
use Kmuharam\Tamex\Responses\CreateShipmentResponse;
use Kmuharam\Tamex\Responses\PrintWaybillResponse;
use Kmuharam\Tamex\Responses\ShipmentStatusResponse;

class MyTamexServices
{
    /**
     * @var \Kmuharam\Tamex\Services\TamexServices
     */
    protected TamexServices $services;

    /**
     * @var boolean
     */
    protected bool $shoudWeGoLive = false;

    /**
     * @var string
     */
    protected string $testingApiKey = 'mytesingapikey';

    /**
     * @var string
     */
    protected string $liveApiKey = 'myliveapikey';

    /**
     * Create a new instance of My Tamex Services.
     *
     * @return void
     */
    public function __construct()
    {
        $this->shoudWeGoLive = false; // or true depending on your environment settings

        $this->services = new TamexServices($this->shoudWeGoLive);
    }

    /**
     * Create shipment request.
     *
     * @return \Kmuharam\Tamex\Responses\CreateShipmentResponse
     */
    public function create(): CreateShipmentResponse {
        $createShipmentRequest = new CreateShipmentRequest();

        $createShipmentRequest->apiKey = $this->shoudWeGoLive ? $this->liveApiKey : $this->testingApiKey;

        $createShipmentRequest->packType = '2'; // 1: Delivery, 2: Pickup
        $createShipmentRequest->packVendorId = 'My store name';

        $createShipmentRequest->packReciverName = 'Receiver name';
        $createShipmentRequest->packReciverPhone = '+966500000000';
        $createShipmentRequest->packReciverCountry = 'SA';
        $createShipmentRequest->packReciverCity = 'City name';

        $createShipmentRequest->packReciverStreet = '26th St.';

        $createShipmentRequest->packDesc = '1 item(s), weight: 3KG , price: 1200SAR.';

        $createShipmentRequest->packNumPcs = 1;
        $createShipmentRequest->packWeight = 3;

        $createShipmentRequest->packCodAmount = '0';
        $createShipmentRequest->packCurrencyCode = 'SAR';

        $createShipmentRequest->packSenderName = 'My store name';
        $createShipmentRequest->packSenderPhone = '+966500000000';
        $createShipmentRequest->packSendCountry = 'SA';
        $createShipmentRequest->packSendCity = 'City name';
        $createShipmentRequest->packSenderStreet = '12th St., Example neighborhood, building No. 1, house No. 1';

        $createShipmentRequest->packDimension = '10:10:10'; // width x height x length

        $response = $this->services->createShipment($createShipmentRequest);

        return $response;
    }

    /**
     * Track shipment status.
     *
     * @param string $packAWB
     *
     * @return \Kmuharam\Tamex\Responses\ShipmentStatusResponse
     */
    public function shipmentStatus(string $packAWB): ShipmentStatusResponse
    {
        $shipmentStatusRequest = new ShipmentStatusRequest();

        $shipmentStatusRequest->apiKey = $this->shoudWeGoLive ? $this->liveApiKey : $this->testingApiKey;

        $shipmentStatusRequest->packAWB = $packAWB;

        $response = $this->services->shipmentStatus($shipmentStatusRequest);

        return $response;
    }

    /**
     * Print shipment waybill.
     *
     * @param string $packAWB
     *
     * @return \Kmuharam\Tamex\Responses\PrintWaybillResponse
     */
    public function printWaybill(string $packAWB): PrintWaybillResponse
    {
        $printWaybillRequest = new PrintWaybillRequest();

        $printWaybillRequest->apiKey = $this->shoudWeGoLive ? $this->liveApiKey : $this->testingApiKey;

        $printWaybillRequest->packAWB = $packAWB;

        $response = $this->services->printWaybill($printWaybillRequest);

        return $response;
    }
}
```

<br>

**For more information about what the requests payload should look like, take a look at the below links:**

-   [Create shipment request parameters](src/Requests/CreateShipmentRequest.php)
-   [Query shipment status request parameters](src/Requests/PrintWaybillRequest.php)
-   [Print waybill request parameters](src/Requests/ShipmentStatusRequest.php)

### Expected responses

**Create shipment response**

```php
<?php
// ...

// contains original response received from the API
$response->raw;

// operation status code
// 0 = Return tmxAWB,
// 90001 = Error in Json Record Format,
// 90003 = API KEY NOT AUTORIZED,
// 90004 = ERROR Contact Support
$response->code;

// operation status text
// 0 = Operation Success,
// 90001 = JSON,
// 90003 = Authorization,
// 90004 = System
$response->data;

// airway bill code
$response->tmxAWB;

// returns true if shipment creation failed
$response->hasError();

// returns true if shipment creation succeeded
$response->created();

// array wrapping response properties and methods
// [
//  'error' => $this->hasError(),
//  'created' => $this->created(),
//  'code' => $this->code,
//  'data' => $this->data,
//  'tmxAWB' => $this->tmxAWB,
// ]
$response->response();

// ...
```

**Shipment status response**

```php
<?php
// ...

// contains original response received from the API
$response->raw;

// operation status code
// 0 = Return tmxAWB,
// 90001 = Error in Json Record Format,
// 90003 = API KEY NOT AUTORIZED,
// 90004 = ERROR Contact Support
$response->code;

// operation status text
// 0 = Operation Success,
// 90001 = JSON,
// 90003 = Authorization,
// 90004 = System
$response->data;

// airway bill code
$response->awb;

// status message code
$response->status;

// Status update date and time
$response->updateOn;

// status message string
$response->message;

// returns true if shipment creation failed
$response->hasError();

// returns true if shipment exists
$response->exists();

// array wrapping response properties and methods
// [
//  'error' => $this->hasError(),
//  'exists' => $this->exists(),
//  'code' => $this->code,
//  'data' => $this->data,
//  'awb' => $this->awb,
//  'status' => $this->status,
//  'updateOn' => $this->updateOn,
//  'message' => $this->message,
// ]
$response->response();

// ...
```

**Print waybill response**

```php
<?php
// ...

// contains original response received from the API
$response->raw;

// operation status code
// 0 = Return tmxAWB,
// 90001 = Error in Json Record Format,
// 90003 = API KEY NOT AUTORIZED,
// 90004 = ERROR Contact Support
$response->code;

// operation status text
// 0 = Operation Success,
// 90001 = JSON,
// 90003 = Authorization,
// 90004 = System
$response->data;

// waybill pdf as base64 string
$response->contents;

// returns true if shipment creation failed
$response->hasError();

// returns true if shipment exists
$response->exists();

// array wrapping response properties and methods
// [
//  'error' => $this->hasError(),
//  'exists' => $this->exists(),
//  'code' => $this->code,
//  'data' => $this->data,
//  'contents' => $this->contents,
// ]
$response->response();

// ...
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ROADMAP -->

## Roadmap

-   [ ] Add support for webhooks
-   [ ] Add documentation pages at [muharam.dev](https://muharam.dev)

See the [open issues](https://github.com/kmuharam/tamex-php/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTRIBUTING -->

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTACT -->

## Contact

Khalid Muharam - devel@muharam.dev

Project Link: [https://github.com/kmuharam/tamex-php](https://github.com/kmuharam/tamex-php)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->

[contributors-shield]: https://img.shields.io/github/contributors/kmuharam/tamex-php.svg?style=for-the-badge
[contributors-url]: https://github.com/kmuharam/tamex-php/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/kmuharam/tamex-php.svg?style=for-the-badge
[forks-url]: https://github.com/kmuharam/tamex-php/network/members
[stars-shield]: https://img.shields.io/github/stars/kmuharam/tamex-php.svg?style=for-the-badge
[stars-url]: https://github.com/kmuharam/tamex-php/stargazers
[issues-shield]: https://img.shields.io/github/issues/kmuharam/tamex-php.svg?style=for-the-badge
[issues-url]: https://github.com/kmuharam/tamex-php/issues
[license-shield]: https://img.shields.io/github/license/kmuharam/tamex-php.svg?style=for-the-badge
[license-url]: https://github.com/kmuharam/tamex-php/blob/master/LICENSE.md
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/khalid-moharrum-18ab41178
