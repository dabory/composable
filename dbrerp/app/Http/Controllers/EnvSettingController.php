<?php

namespace App\Http\Controllers;

use App\Helpers\File;

class EnvSettingController
{
    public function setGeneralInfo()
    {
        File::changeEnvironmentVariable('ERP_PARA_CUSTOM_THEME', request('ErpParaCustomTheme'));
        File::changeEnvironmentVariable('ERP_THEMES', request('ErpThemes'), true);
        File::changeEnvironmentVariable('PRO_THEME', request('ProTheme'));
        File::changeEnvironmentVariable('LOCALE_SEQUENCE', request('LocaleSequence'), true);
        File::changeEnvironmentVariable('APP_NAME', request('AppName'));
        File::changeEnvironmentVariable('APP_ENV', request('AppEnv'));
        File::changeEnvironmentVariable('APP_DEBUG', request('AppDebug'));
        File::changeEnvironmentVariable('APP_URL', request('AppUrl'));

        File::changeEnvironmentVariable('MAIL_MAILER', request('MailMailer'));
        File::changeEnvironmentVariable('MAIL_HOST', request('MailHost'));
        File::changeEnvironmentVariable('MAIL_PORT', request('MailPort'));
        File::changeEnvironmentVariable('MAIL_USERNAME', request('MailUserName'));
        File::changeEnvironmentVariable('MAIL_PASSWORD', request('MailPassword'));
        File::changeEnvironmentVariable('MAIL_ENCRYPTION', request('MailEncryption'));
        File::changeEnvironmentVariable('MAIL_FROM_ADDRESS', request('MailFromAddress'));

        File::changeEnvironmentVariable('CDN_TYPE', request('CdnType'));
        File::changeEnvironmentVariable('MEDIA_URL', request('MediaUrl'));
        File::changeEnvironmentVariable('FAVICON_PATH', request('FaviconPath'));
        File::changeEnvironmentVariable('TAG_LINE', request('TagLine'));
        File::changeEnvironmentVariable('APP_MOBILE_NO', request('AppMobileNo'));
//        File::changeEnvironmentVariable('IS_SKIP_DBUPDATE', request('IsSkipUpdate') === true ? '1' : '0');
        File::changeEnvironmentVariable('IS_SKIP_DBUPDATE', request('IsSkipUpdate'));
        File::changeEnvironmentVariable('IS_ON_MEMBER_SIGNUP', request('IsOnMemberSignup') === true ? '1' : '0');
        return response([], 200);
    }

    public function setAwsS3()
    {
        File::changeEnvironmentVariable('AWS_ACCESS_KEY_ID', request('AccessKeyId'), false, '.env.aws.s3');
        File::changeEnvironmentVariable('AWS_SECRET_ACCESS_KEY', request('SecretAccessKey'), false, '.env.aws.s3');
        File::changeEnvironmentVariable('AWS_DEFAULT_REGION', request('DefaultRegion'), false, '.env.aws.s3');
        File::changeEnvironmentVariable('AWS_BUCKET', request('Bucket'), false, '.env.aws.s3');
        return response([], 200);
    }

    public function setAligoTextSend()
    {
        File::changeEnvironmentVariable('SMS_TYPE', 'aligo');
        File::changeEnvironmentVariable('SMS_APIKEY', request('Key'));
        File::changeEnvironmentVariable('SMS_USER', request('UserId'));
        File::changeEnvironmentVariable('SMS_SENDER', request('Sender'));
        return response([], 200);
    }
}
