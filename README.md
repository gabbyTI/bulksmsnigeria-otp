# A laravel package for sending otp to mobile phone

### Installation
```bash
composer require gabbyti/bulksmsnigeria-otp
```

### Vendor Publish
This package includes a config file and an OtpController, first publish the files:
```bash
php artisan vendor:publish --provider="Gabbyti\BulkSmsNigeriaOtp\BulkSmsNigeriaOtpServiceProviderr"  --force
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
