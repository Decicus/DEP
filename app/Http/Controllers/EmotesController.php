<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
class EmotesController extends Controller
{
    /**
     * Kappa
     *
     * @var string
     */
    private $Kappa = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABkAAAAcCAQAAAA+LdxbAAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAAAEgAAABIAEbJaz4AAALDSURBVDjLddRLa5xlGIDh65vpJF8mk0xmJiapiSY10gNSlWorilJ0IejabRduXbkT/4H/QrEbcSG4cFURV8UDtlYQp01LaJI2hyaZUyeZ4/e6sDhJmz7bhwte3gfuqOvJ+SrkzVj2QNGl6PFt9Dj5Jaz4QeysdZueUTDk0+ip5NewpCZrRVfaqIyeNW2vmfNBdAT5OWwJghl31T1UNeqWmjmnLWlIXI4OkR9DRSJlzIoa/vYXEiUz0iqWpZzwfcSx/8CN0BTbd0+s6b51D81Zl1WyIVLStmsCj8hyqMnouGtVw55dm2YUTJq2aN0dd7Qldgak7KGWsttuq8rL6euYdN5JRW1LbvjdvgcD8puujrJl60aUTDluytvOGdeyb9KiYEVnQP4Qa1hVkRhR9KbEnDeMaunqYdh5N5UHJGXbPR2RFy2YN+84hh3T0dPXsqfggs0Bia2pGjXrdafMec6sIRmRRCQrlkjMGxuQb6IzIRKJTXnXGTGo29aQktfSQ8H4gHBMT2LG+16WQs1VN2QsKFq1bE1a3uxB8qFv5XzkHS3X/eO2mxqmjCi54ictec86NyBXw0Up153Gni23lHUVLXjJKaNiY2IzXhiQt6I/wwVBgoL3nLXmvq4TTiq5aEjasGnFgw/LmXXJlD1ZY8acUJfRE0mbt6Uo1lI7SCZNK6ir68sYkpJX0VHEpLyMYTs2DpKJKB36+tI6GrqCiqq8lnEPVLSN2NY8SGhqI6NvX0VVz/OarmjbVTetae/Rvf4ncVQOeeOCIRP6svJSFi3ZEPSVRKLDhFeja6ElK5IzbsM1Qd++WFPauIZPoscIdTtyYlVDmFazrCIxrWjt0X89EaXvQiKjK3jFnFVlq3qKdmz6InpKx/gykLcop6pmW1Nk3edHRWkwX4esvAkFfVt2VHx8IH5HEi6HfX05Qc2ezw7V8l8tNhNJnVppEAAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxMi0wMy0wNlQxNTowMzozNS0wODowMACjc9IAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTItMDMtMDZUMTU6MDM6MzUtMDg6MDBx/stuAAAARnRFWHRzb2Z0d2FyZQBJbWFnZU1hZ2ljayA2LjYuNi0yIDIwMTAtMTItMDMgUTE2IGh0dHA6Ly93d3cuaW1hZ2VtYWdpY2sub3JnQBY9wgAAABh0RVh0VGh1bWI6OkRvY3VtZW50OjpQYWdlcwAxp/+7LwAAABd0RVh0VGh1bWI6OkltYWdlOjpoZWlnaHQAMjhTy6IIAAAAFnRFWHRUaHVtYjo6SW1hZ2U6OldpZHRoADI1VyScmwAAABl0RVh0VGh1bWI6Ok1pbWV0eXBlAGltYWdlL3BuZz+yVk4AAAAXdEVYdFRodW1iOjpNVGltZQAxMzMxMDc1MDE1jO/flwAAABF0RVh0VGh1bWI6OlNpemUAODU3QkK8TFNyAAAALXRFWHRUaHVtYjo6VVJJAGZpbGU6Ly8vdG1wL21pbmltYWdpY2sxNzcxNy0yMy5wbmcV7/n0AAAAAElFTkSuQmCC');

    /**
     * Sends a normal GET request to the specified URL
     *
     * @param  string $url     URL to request
     * @param  array $headers HTTP headers to send with the request
     * @return Response
     */
    private function get($url = '', $headers = [])
    {
        $settings = [
            'http_errors' => false,
            'headers' => $headers
        ];
        $client = new Client;
        $request = $client->request('GET', $url, $settings);
        return $request;
    }

    /**
     * Returns a response with set headers
     *
     * @param  mixed   $body    Response body to send
     * @param  array   $headers HTTP headers
     * @return response
     */
    private function response($body = '', $headers = [])
    {
        return response($body)->withHeaders($headers);
    }

    /**
     * Proxies the specified Twitch emote
     *
     * @param  string $size
     * @param  string $id
     * @return Response
     */
    public function twitch($size, $id)
    {
        $sizes = [
            "1.0",
            "2.0",
            "3.0"
        ];
        $suffix = ".0";
        $size = "2.0";

        if (!in_array($size . $suffix, $sizes)) {
            $size = $size . $suffix;
        } else {
            $size = "2.0";
        }

        $url = sprintf('https://static-cdn.jtvnw.net/emoticons/v1/%s/%s', $id, $size);
        $request = $this->get($url);

        $body = $this->Kappa;
        if ($request->getStatusCode() === 200) {
            $body = $request->getBody();
        }
        return $this->response($body, ['Content-Type' => 'image/png']);
    }

    /**
     * Proxies the specified BetterTTV emote
     *
     * @param  string $size
     * @param  string $id
     * @param  string $extension
     * @return Response
     */
    public function bttv($size, $id, $extension)
    {
        $extension = strtolower($extension);
        $sizes = [
            "1x",
            "2x",
            "3x"
        ];
        $suffix = "x";

        switch ($extension) {
            case "gif":
                $type = "image/gif";
                break;

            default:
                $type = "image/png";
                break;
        }

        if (in_array($size . $suffix, $sizes)) {
            $size = $size . $suffix;
        } else {
            $size = "2x";
        }

        $url = sprintf('https://cdn.betterttv.net/emote/%s/%s', $id, $size);
        $request = $this->get($url);

        $body = $this->Kappa;
        if ($request->getStatusCode() === 200) {
            $body = $request->getBody();
        }
        return $this->response($body, ['Content-Type' => $type]);
    }
}
