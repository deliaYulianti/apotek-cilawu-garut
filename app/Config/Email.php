<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use App\Models\ModelSetting;
class Email extends BaseConfig
{
    protected $ModelSetting;

    /**
     * Constructor untuk menginisialisasi properti.
     */
    public function __construct() {
        $this->ModelSetting = new ModelSetting();
        
        // Mendapatkan data web dari ModelSetting
        $dataWeb = $this->ModelSetting->DataWeb();

        // Mengambil nilai email dari $dataWeb
        $email = isset($dataWeb['email']) ? $dataWeb['email'] : '';
        $name = isset($dataWeb['name']) ? $dataWeb['name'] : '';
        $apppassword = isset($dataWeb['apppassword']) ? $dataWeb['apppassword'] : '';
        $SMTPHost = isset($dataWeb['SMTPHost']) ? $dataWeb['SMTPHost'] : '';
        $SMTPPort = isset($dataWeb['SMTPPort']) ? $dataWeb['SMTPPort'] : '';
        $SMTPCrypto = isset($dataWeb['SMTPCrypto']) ? $dataWeb['SMTPCrypto'] : '';
        // Inisialisasi properti $fromEmail dengan nilai email yang diperoleh
        $this->fromEmail = $email;
        $this->fromName =  $name;
        $this->SMTPUser =  $email;
        $this->SMTPPass =  $apppassword;
        $this->SMTPHost =  $SMTPHost;
        $this->SMTPPort =  $SMTPPort;
        $this->SMTPCrypto =  $SMTPCrypto;

    }

    /**
     * @var string
     */
    public $fromEmail; 

    /**
     * @var string
     */
    public $fromName;

    /**
     * @var string
     */
    public $recipients;

    /**
     * The "user agent"
     *
     * @var string
     */
    public $userAgent = 'CodeIgniter';

    /**
     * The mail sending protocol: mail, sendmail, smtp
     *
     * @var string
     */
    public $protocol = 'smtp';

    /**
     * The server path to Sendmail.
     *
     * @var string
     */
    public $mailPath = '/usr/sbin/sendmail';

    /**
     * SMTP Server Address
     *
     * @var string
     */
    public $SMTPHost;

    /**
     * SMTP Username
     *
     * @var string
     */
    public $SMTPUser;

    /**
     * SMTP Password
     *
     * @var string
     */
    public $SMTPPass;

    /**
     * SMTP Port
     *
     * @var int
     */
    public $SMTPPort;

    /**
     * SMTP Timeout (in seconds)
     *
     * @var int
     */
    public $SMTPTimeout = 120;

    /**
     * Enable persistent SMTP connections
     *
     * @var bool
     */
    public $SMTPKeepAlive = false;

    /**
     * SMTP Encryption. Either tls or ssl
     *
     * @var string
     */
    public $SMTPCrypto;

    /**
     * Enable word-wrap
     *
     * @var bool
     */
    public $wordWrap = true;

    /**
     * Character count to wrap at
     *
     * @var int
     */
    public $wrapChars = 76;

    /**
     * Type of mail, either 'text' or 'html'
     *
     * @var string
     */
    public $mailType = 'html';

    /**
     * Character set (utf-8, iso-8859-1, etc.)
     *
     * @var string
     */
    public $charset = 'UTF-8';

    /**
     * Whether to validate the email address
     *
     * @var bool
     */
    public $validate = false;

    /**
     * Email Priority. 1 = highest. 5 = lowest. 3 = normal
     *
     * @var int
     */
    public $priority = 3;

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     *
     * @var string
     */
    public $CRLF = "\r\n";

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     *
     * @var string
     */
    public $newline = "\r\n";

    /**
     * Enable BCC Batch Mode.
     *
     * @var bool
     */
    public $BCCBatchMode = false;

    /**
     * Number of emails in each BCC batch
     *
     * @var int
     */
    public $BCCBatchSize = 200;

    /**
     * Enable notify message from server
     *
     * @var bool
     */
    public $DSN = false;
}