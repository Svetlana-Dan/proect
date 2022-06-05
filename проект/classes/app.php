<?php
  include_once 'database.php';
  include_once 'fun.php';

  class App
  {
    protected $data = null;
    protected array $data_errors;
    const SEPARATOR = '||';
    public ?int $id;
    public ?string $ip;
    //public ?int $date;
    public ?string $name = '';
    public ?string $place = '';
    public ?string $date = '';
    public ?int $duration = 10;
    public ?string $comment = '';
    //public ?string $topic = '';
    public bool $if_done = false;
    public ?string $status = '';
    protected static string $datafile = 'data/data.txt';
  	public ?string $type ='текущие';
    protected array $errors = [];
    public ?string $login = '';
    public ?string $password = '';
    
   	public function __construct(array $topics, array $durations, array $_data = [])
    { 
   	  $this->data_errors = [];
      $this->data = array(
        ':name' => $_data['name'] ?? '',
        ':place' => $_data['place'] ?? '',
        ':date' => $_data['date'] ?? '',
        ':duration' => convertIndex($_data['duration'], $durations) ?? null,
        ':topic' =>  convertIndex($_data['topic'], $topics),
        ':comment' => $_data['comment'] ?? '',
      );
      //$this->id = uniqid();
      //$this->ip = getenv('REMOTE_ADDR');
      //$this->date = time();
      //$this->fill($data);
      //$this->status = '';
    }

    //public function fill(array $_data, array $topics, array $durations)
    //{
      //$this->data_errors = [];
      //$this->data = array(
        //':name' => $_data['name'] ?? '',
        //':place' => $_data['place'] ?? '',
        //':date' => $_data['date'] ?? '',
        //':duration' => convert_to_index($_data['duration'], $durations),
        //':topic' =>  convert_to_index($_data['topic'], $topics),
        //':comment' => $_data['comment'] ?? ''
      //);
        //$this->name = $data['name'] ?? '';
        //$this->place = $data['place'] ?? '';
  			//$this->date = $data['date'] ?? '';
      	//$this->duration = (int)$data['duration'] ?? '';
      	//$this->topic = $data['topic'] ?? '';
      	//$this->comment = $data['comment'] ?? '';
    //} 
      
  	private function check_errors() : void
     {
        if (!$this->data[':name'])
        {
     		  $this->data_errors[] = 'Название не заполнено';
     	}
     	if (!$this->data[':place'])
     	{
     		$this->data_errors[] = 'Место не заполнено';
     	}
     	if (!$this->data[':date'])
     	{
     		$this->data_errors[] = 'Дата не заполнена';
     	}
     }

    public function validate() : bool
    {
       return !(count($this->data_errors)) ;
    }

    private function hasErrors() : void
     {
       echo '<ul style="color:red;">';
       foreach ($this->data_errors as $error) 
       {
       	echo '<li>' . $error . '</li>';
       }
       echo '</ul>';
     }

    public function getErrors() : string
    {
       $data = '<ul style="color:red;">';
       foreach ($this->data_errors as $error) 
       {
         $data .= '<li>' . $error . '</li>';
       }
       $data .= '</ul>';
       return $data;
    }

    public function save() : bool
    {
      $this->check_errors();
       if ($this->validate())
       {
         $sql = Database::exec('INSERT INTO tasks (`name`, `place`, `date`, `duration`, `topic`, `comment`, `if_done`, `created_at`) VALUES (:name, :place, :date, :duration, :topic, :comment, 1, NOW());', $this->data);
         return true;
       }
       else
       {
         return false;
       }
      //$pdo = new PDO("mysql:host=127.0.0.1;dbname=test_3", "root", "user2020");
      //$sql = Database::prepare('INSERT INTO user1 (`name`, `place`, `date`, `duration`, `topic`, `comment`, `if_done`, `created_at`) VALUES (:name, :place, :date, :duration, :topic, :comment, :if_done, NOW());');
      //$sql->execute([
      //  'name'=>$this->name, 
      //  'place'=>$this->place, 
      //  'date'=>$this->date, 
      //  'duration'=>(int)$this->duration, 
      //  'topic'=>$this->topic, 
      //  'comment'=>$this->comment,
      //  'if_done'=>(int)$this->if_done,
      //]);
      //$pdo->prepare('INSERT INTO apps (`ip`, `name`, `lastname`, `email`, `phone`, `topic`, `pay`, `confirm`, `created_at`) VALUES (\''.this->id.'\',\''.this->name.'\',\''.this->lastname.'\',\''.this->email.'\',\''.this->phone.'\',\''.this->topic_id.'\',\''.this->pay_id.'\',\''.this->confirm.'\',\''.this->created_at.'\')');
      //$this->ensureDataDir();
      //file_put_contents(static::$datafile, $this->toString(), FILE_APPEND);
    }

    public function update($task_id, $if_done) : bool
    {
      $this->check_errors();
      if ($this->validate())
      {
        $this->data[":if_done"] = $if_done;
        $this->data[":id"] = $task_id;
        Database::exec("UPDATE `tasks` SET name = :name, place = :place, date = :date, duration = :duration, topic = :topic, comment = :comment, if_done = :if_done, updated_at = NOW() WHERE id = :id LIMIT 1;", $this->data);
        return true;
      }
      else
      {
         return false;
      }
    }
  
    public static function loadAll() : array
    {
      $data = Database::exec("SELECT * FROM `tasks`");  
      return $data;
      //return Database::query('SELECT * FROM user1 WHERE deleted_at IS NULL;', static::class);
      //$sql = 'SELECT * FROM `:login` WHERE deleted_at IS NULL;';
      //$sql->execute([
      //  'login'=>$this->login,
      //]);
      //$items = [];
      //$contents = file_get_contents(static::$datafile);
      //$lines = explode("\n", trim($contents));
      //foreach($lines as $line)
      //{
      //  $cols = explode(static::SEPARATOR, trim($line));
      //  $item = new static; 
      //  $item->fill([ 
      //    'id' => $cols[0],
      //    'ip' => $cols[1],
      //    'date' => $cols[2],
      //    'name' => $cols[3],
      //    'lastname' => $cols[4],
      //    'email' => $cols[5],
      //    'phone' => $cols[6],
      //    'topic' => $cols[7],
      //    'pay' => $cols[8],
      //    'confirm' => $cols[9],
      //    'status' => $cols[10],
      //  ]);
      //$items[] = $item;
      //}
      //return $items;
    }

  }