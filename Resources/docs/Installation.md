How to install AWS SES Monitor Bundle
=====================================

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require serendipity_hq/aws-ses-monitor-bundle "~0"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding the following line in the `app/AppKernel.php`
file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new SerendipityHQ\Bundle\AwsSesMonitorBundle\AwsSesMonitorBundle(),
        );

        // ...
    }

    // ...
}
```

([Go back to index](Index.md)) | Next step: [Configure](Configuration.md)