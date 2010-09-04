Installation
============

  1. Add this bundle and Abraham Williams' Twitter library to your project as Git submodules:

          $ git submodule add git://github.com/kriswallsmith/TwitterBundle.git src/Bundle/Kris/TwitterBundle
          $ git submodule add git://github.com/abraham/twitteroauth.git src/vendor/twitteroauth

  2. Add the `TwitterOAuth` class to your project's autoloader bootstrap script:

          // src/autoload.php
          spl_autoload_register(function($class)
          {
              if ('TwitterOAuth' == $class) {
                  require_once __DIR__.'/vendor/twitteroauth/twitteroauth/twitteroauth.php';
                  return true;
              }
          });

  3. Add this bundle to your application's kernel:

          // application/ApplicationKernel.php
          public function registerBundles()
          {
              return array(
                  // ...
                  new Bundle\Kris\TwitterBundle\KrisTwitterBundle(),
                  // ...
              );
          }

  4. Configure the `twitter` service in your YAML or XML configuration:

          # application/config/config.yml
          twitter.api:
            alias: twitter
            consumer_key: 123456879
            consumer_secret: s3cr3t

          # application/config/config.xml
          <twitter:api
            alias="twitter"
            consumer_key="123456879"
            consumer_secret="s3cr3t"
          />

Using Twitter @Anywhere
-----------------------

A templating helper is included for using Twitter @Anywhere. To use it, first
call the `->setup()` method toward the top of your DOM:

      <?php echo $view['twitter_anywhere']->setup() ?>
    </head>

Once that's done, you can queue up JavaScript to be run once the library is
actually loaded:

    <span id="twitter_connect"></span>
    <?php $view['twitter_anywhere']->queue('T("#twitter_connect").connectButton()') ?>

Finally, call the `->initialize()` method toward the bottom of the DOM:

      <?php $view['twitter_anywhere']->initialize() ?>
    </body>

### Configuring Twitter @Anywhere

You can define a custom callback URL to use for the Twitter @Anywhere
authentication process by setting a `kris.twitter.anywhere.callback_url`
parameter in your configuration.
