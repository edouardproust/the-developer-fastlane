<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/livre-or-php-1137');

// START EDITING

title('Instructions & result'); // '1' or '2' for preset titles

    p('We create a guestbook page in which visitors can leave a message. The purpose of the exercise is to practice object-oriented PHP.');
    
        accordionin();
            accordionli('Instructions',<<<HTML
                <div class="paragraph">
                    <b>We will have a page with a form</b>
                    <ul>
                        <li>A field for the username</li>
                        <li>A message field</li>
                        <li>One Button</li>
                    </ul>
                    (The form will have to be validated and we will not accept pseudonyms of less than 3 characters nor messages of less than 10 characters)
                </div>
                <div class="paragraph">
                    <b>We will create a "messages" file that will contain one message per line.</b>
                    <ul>
                        <li>we will use serialize and an array ["username" => "....", "message" => "....", "date" => ]</li>
                        <li>To serialize the messages we will use the functions json_encode(array) and json_decode(array, true).</li>
                    </ul>
                </div>
HTML);
            accordionli('Formating',<<<HTML
                The page should display all messages under the form formatted as follows:<br><br>
                <div style="border: 1px solid #ddd; border-radius: 5px; padding: 20px">
                    <strong>Pseudo</strong> <em> on 03/12/2009 at 12:00 pm</em><br>
                    The message
                </div>
                <p>Line breaks must be kept nl2br</p>
HTML);
            accordionli('Constraints',<<<HTML
                <div class="paragraph">
                    <ol>
                        <li><b>Use a class to represent a Message</b>
                            <ul>
                                <li>new Message(string \$username, string \$message, DateTime \$date = null)</li>
                                <li>isValid(): bool</li>
                                <li>getErrors(): array</li>
                                <li>toHTML(): string</li>
                                <li>toJSON(): string</li>
                                <li>Message::fromJSON(string): Message</li>
                            </ul>
                        </li>
                        <li><b>Use a class to represent the guestbook</b>
                            <ul>
                                <li>new GuestBook(\$file)</li>
                                <li>addMessage(Message \$message)</li>
                                <li>getMessages(): array</li>
                            </ul>
                        </li>
                    </ol>
                </div>
HTML);
        accordionout();

        resultin();
            exo_gallery_link(100, [1], 'guestbook.php', false, 0, 0);
            exo_gallery_link(50, [2, 3], 'guestbook.php', true, 0, 0);
        resultout();

title('Code');

        p('<h4>guestbook.php</h4>');

            codein(); ?>
&lt;?php
$title = "Guest book";
require_once 'includes/header.php';
require_once 'class/Message.php';
require_once 'class/GuestBook.php';

$errors = null;
$success = false;
$guestbook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');
if(isset($_POST['username'], $_POST['message'])) {
  $message = new Message($_POST['username'], $_POST['message'], new Datetime());
  if ($message->isValid()) {
    $guestbook->addMessage($message);
    $success = true; <l>// Display a success message is successfully added to the 'messages' file (as a JSON string)</l>
    $_POST = []; <l>// Empty the form;</l>
  } else {
    $errors = $message->getErrors();
  }
}
$messages = $guestbook->getMessages();
?>

&lt;p class="lead mb-5">This guestbook system has been realized with &lt;b>object oriented&lt;/b> PHP.&lt;/p>

&lt;div class="row">

&lt;div class="col-md-6 mb-4">
  &lt;h2 class="mb-4">Share what you think!&lt;/h2>
  &lt;?php if (!empty($errors)): ?>
    &lt;div class="alert alert-danger">Invalid form&lt;/div>
  &lt;?php endif; ?>
  &lt;?php if ($success): ?>
    &lt;div class="alert alert-success">Thank you for your message!&lt;/div>
  &lt;?php endif; ?>
  &lt;form action="" method="post">
    &lt;div class="form-group">
      &lt;label>Username&lt;/label>
      &lt;input type="text" name="username" value="&lt;?= isset($_POST['username']) ? htmlentities($_POST['username']) : '' ?>" class="form-control &lt;?= isset($errors['username']) ? 'is-invalid' : '' ?>">&lt;/input>
      &lt;?php if (isset($errors['username'])): ?>
        &lt;div class="invalid-feedback">&lt;?= $errors['username'] ?>&lt;/div>
      &lt;?php endif; ?>
    &lt;/div>
    &lt;div class="form-group">
      &lt;label>Your message&lt;/label>
      &lt;textarea name="message" rows="3" class="form-control &lt;?= isset($errors['message']) ? 'is-invalid' : '' ?>">&lt;?= isset($_POST['message']) ? htmlentities($_POST['message']) : '' ?>&lt;/textarea>      
      &lt;?php if (isset($errors['message'])): ?>
        &lt;div class="invalid-feedback">&lt;?= $errors['message'] ?>&lt;/div>
      &lt;?php endif; ?>
    &lt;/div>
    &lt;button type="submit" class="btn btn-primary">Send a thought&lt;/button>
  &lt;/form>
  &lt;/div>

  &lt;div class="col-md-6">
    &lt;h2 class="mb-4">Posts from our users:&lt;/h2>
    &lt;?php if(!empty($messages)): ?>
      &lt;div>
        &lt;?php foreach ($messages as $message): ?>
          &lt;?= $message->toHTML() ?>
        &lt;?php endforeach ?>
      &lt;/div>
    &lt;?php else: ?>
      &lt;p>No message yet. Be the first to write one!&lt;/p>
    &lt;?php endif; ?>
  &lt;/div>

&lt;/div>

&lt;?php require 'includes/footer.php'; ?><?php codeout();

        p('<h4>GuestBook.php</h4>');

            codein(); ?>
&lt;?php
require_once 'Message.php';

class GuestBook {

    public $file;

    public function __construct(string $file)
    {
        if (!is_dir(dirname($file))) { <l>// Check if file's path folders exist (if not: create them)</l>
            mkdir(dirname($file), 0777, true);
        }
        if (!file_exists($file)) { <l>// Check if file exists (if not: create it)</l>
            touch($file); <l>// touch() function allows to create a new file.</l>
        }
        $this->file = $file;
    }

    public function addMessage(Message $message): void
    {
       file_put_contents($this->file, $message->toJSON() . PHP_EOL, FILE_APPEND);
    }
    public function getMessages()
    {
        $content = trim(file_get_contents($this->file));
        $messages = [];
        if(!empty($content)) {
            $lines = (array)explode( PHP_EOL, $content);
            foreach ($lines as $line) {
                $messages[] = Message::fromJSON($line);
            }
        }
        return array_reverse($messages);
    }

}<?php codeout();

        p('<h4>Message.php</h4>');

            codein(); ?>
&lt;?php
class Message {

    const LIMIT_USERNAME = 3; <l>// We create constants to be able to change them easily if needed later on.</l>
    const LIMIT_MESSAGE = 10;
    private $username;
    private $message;
    private $date;

    public function __construct(string $username, string $message, ?DateTime $date = null) 
        <l>// Question mark before the value type (DateTime) to say: "if value is null, then value will have to be a DateTime object"</l>
    {
        $this->username = $username;
        $this->message = $message;
        $this->date = $date ?: new DateTime(); <l>// If $date = null, thencreate a new DateTime object</l>
    }
    public function isValid(): bool
    {
        return empty($this->getErrors());
    }
    public function getErrors(): array
    {
        $errors = [];
        if (strlen($this->username) &lt; self::LIMIT_USERNAME) {
            $errors['username'] = "Username is too short (3 characters min.)";
        }
        if (strlen($this->message) &lt; self::LIMIT_MESSAGE) {
            $errors['message'] = "Message is too short (10 characters min.)";
        }
        return $errors;
    }
    public function toJSON(): string 
    {
        return json_encode([
            'username' => $this->username,
            'message' => $this->message,
            'date' => $this->date->getTimestamp()
        ]);
    }
    public function toHTML()
    {
        $username = htmlentities($this->username);
        $this->date->setTimeZone(new DateTimeZone('Europe/Paris')); <l>// Change the timezone to Paris on display</l>
        $date = 'on ' . $this->date->format("F n, Y") . ' at ' . $this->date->format("g:i a");
        $message = nl2br(htmlentities($this->message));
            <l>// nl2br() function cahnge the linebreaks that are not readen in HTML into &lt;br> tags</l>
        return &lt;&lt;&lt;HTML
        &lt;div class="card mb-2">
            &lt;div class="card-body">
                &lt;div class="mb-2">
                    &lt;b>$username&lt;/b>
                    &lt;span class="text-muted">&lt;i>$date&lt;/i>&lt;/span>
                &lt;/div>
                $message
            &lt;/div>
        &lt;/div>
HTML;
    }
    public static function fromJSON(string $json): Message 
    {
        $data = json_decode($json, true);
        $date = new DateTime("@" . $data['date']);
        return new self($data['username'], $data['message'], $date);
            <l>// It's necessary to convert back into an array of objects because we'll use methods on $message in guestbook.php</l>
            <l>// new DateTime("@$ts") is a shortened version of new DateTime instantiation + setTimestamp() --> ref: https://www.php.net/manual/en/datetime.settimestamp.php ('Notes' paragraph)</l>
    }
}<?php codeout();

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>