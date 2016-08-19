<?php

namespace Norets\FreshOffice;

class API
{
    /* 	api id */

    protected $apiID           ='940';
    /* 	api ключ */
    protected $apiPass         ='eHzuSKGmQiP-nliCc8icjMlHlJE2Rb4V';
    /* 	контрагенты */
    protected $companyes       =array ();
    /* 	контактные лица */
    protected $contact_people  =array ();
    /* 	телефоны контактных лиц */
    protected $phones          =array ();
    /* 	emails контактных лиц */
    protected $emails          =array ();
    /* 	статусы сообщений */
    protected $message_statused=array ();
    /* 	типы сообщений */
    protected $message_types   =array ();
    /* 	типы задач   */
    protected $task_types      =array ();
    /* 	статусы задач */
    protected $task_status     =array ();
    /* 	пользователи системы */
    protected $users           =array ();


    /* 	Все сделки */
    protected $deal_all      =array ();
    /* 	Сделки на этой неделе */
    protected $deal_this_week=array ();
    /* 	Типы сделок */
    protected $deal_types    =array ();
    /* 	Статусы сделки */
    protected $deal_statuses =array ();
    /* 	Товары сделки */
    protected $deal_tovars   =array ();



    /* 	Все документы */
    protected $docs_all     =array ();
    /* 	Все статусы документов */
    protected $docs_statuses=array ();
    /* 	Все типы документов */
    protected $docs_types   =array ();
    /* 	Товары документа */
    protected $docs_tovars  =array ();
    protected $projects_all=array ();
    protected $projects_types=array ();
    protected $projects_statuses=array ();
    protected $projects_tovars=array ();

    /* 	ID пользователя системы РУКОВОДИТЕЛЯ */
    protected $chief_id         =37;
    /* 	ID пользователя системы МЕНЕДЖЕРА */
    protected $manager_id       =38;
    /* 	Рабочие часы НАЧАЛО - ЧАС */
    protected $work_time_start_h=9;
    /* 	Рабочие часы НАЧАЛО - МИН */
    protected $work_time_start_m=0;
    /* 	Рабочие часы ОКОНЧАНИЕ - ЧАС */
    protected $work_time_end_h  =23;
    /* 	Рабочие часы ОКОНЧАНИЕ - МИН */
    protected $work_time_end_m  =0;

    public function __construct($apiID,$apiPass)
    {
        $this->apiID=$apiID ? $apiID : null;
        $this->apiPass=$apiPass ? $apiPass : null;
        return $this;
    }

    public function getParamsNewTaskLeadFORM()
    {
        return array (
            /*  ID контрагента	 */
            'company_id'  => 68,
            /*  ID пользователя  которому назначена задача */
            'user_id'     => $this->manager_id,
            /*  ID пользователя  который назначил задачу */
            'creator_id'  => $this->chief_id,
            /*  ID категории задачи */
            'category_id' => 2,
            /*  ID типа задачи */
            'type_id'     => 8,//// ЗАДАЧА
            /*  ID статуса задачи */
            'status_id'   => 3,/// В ПРОЦЕССЕ
        );
    }

    public function getAuthHeader()
    {
        return 'Authorization:Basic ' . base64_encode($this->apiID . ':' . $this->apiPass);
    }

    public function getAllCompany()
    {
        if (empty($this->companyes)) {
            $response       =$this->request("https://api.myfreshcloud.com/companies");
            $this->companyes=$response->d->results;
        }
        return $this->companyes;
    }

    public function getContactPeoples()
    {

        if (empty($this->contact_people)) {
            $response            =$this->request("https://api.myfreshcloud.com/contacts");
            $this->contact_people=$response->d->results;
        }
        return $this->contact_people;
    }

    public function getContactPeoplesEmails()
    {
        if (empty($this->emails)) {
            $response    =$this->request("https://api.myfreshcloud.com/emails");
            $this->emails=$response->d->results;
        }
        return $this->emails;
    }

    public function getContactPeoplesPhones()
    {
        if (empty($this->phones)) {
            $response    =$this->request("https://api.myfreshcloud.com/phones");
            $this->phones=$response->d->results;
        }
        return $this->phones;
    }

    public function getUsers()
    {
        if (empty($this->users)) {
            $response   =$this->request("https://api.myfreshcloud.com/users");
            $this->users=$response->d->results;
        }
        return $this->users;
    }

    public function getMessageStatuses()
    {
        if (empty($this->message_statused)) {
            $response              =$this->request("https://api.myfreshcloud.com/message_statuses/");
            $this->message_statused=$response->d->results;
        }
        return $this->message_statused;
    }

    public function getMessageTypes()
    {
        if (empty($this->message_types)) {
            $response           =$this->request("https://api.myfreshcloud.com/message_types/?orderby=descr");
            $this->message_types=$response->d->results;
        }
        return $this->message_types;
    }

    public function getTaskTypes()
    {
        if (empty($this->task_types)) {
            $response        =$this->request("https://api.myfreshcloud.com/task_types");
            $this->task_types=$response->d->results;
        }
        return $this->task_types;
    }

    public function getTaskStatuses()
    {
        if (empty($this->task_status)) {
            $response         =$this->request("https://api.myfreshcloud.com/task_statuses");
            $this->task_status=$response->d->results;
        }
        return $this->task_status;
    }

    public function getDealStatuses()
    {
        if (empty($this->deal_statuses)) {
            $response           =$this->request("https://api.myfreshcloud.com/tip_deal");
            $this->deal_statuses=$response->d->results;
        }
        return $this->deal_statuses;
    }

    public function getDealTypes()
    {
        if (empty($this->deal_types)) {
            $response        =$this->request("https://api.myfreshcloud.com/status_deal");
            $this->deal_types=$response->d->results;
        }
        return $this->deal_types;
    }

    public function getAllDeal()
    {
        if (empty($this->deal_all)) {
            $response      =$this->request('https://api.myfreshcloud.com/deal?$orderby=date_start');
            $this->deal_all=$response->d->results;
        }
        return $this->deal_all;
    }

    public function getDealThisWeek()
    {
        if (empty($this->deal_all)) {
            $this->getAllDeal();
        }
        $result          =array ();
        $dateFirstDayWeek=new \DateTime();
        $dateFirstDayWeek->modify('last Monday');
        $dateLastDayWeek =new \DateTime();
        $dateLastDayWeek->modify('Sunday');
        foreach ($this->deal_all as $k => $deal) {
            $dateStart=new \DateTime($deal->date_start);
            $dateEnd  =new \DateTime($deal->date_finish);
            if ($dateStart >= $dateFirstDayWeek AND $dateStart <= $dateLastDayWeek || $dateEnd >= $dateFirstDayWeek AND $dateEnd <= $dateLastDayWeek) {
                $result[]=$deal;
            }
        }
        return $result;
    }

    /* 	Получить сделки начало которых через n-дней */

    public function getDealsAfterDays($countDay)
    {
        if (empty($this->deal_all)) {
            $this->getAllDeal();
        }
        $result   =array ();
        $dateToday=new \DateTime('now');
        foreach ($this->deal_all as $deal) {
            $dateStart=new \DateTime($deal->date_start);
            $dateStart->modify('-' . $countDay . ' day');
            if ($dateToday->format('d-m-Y') == $dateStart->format('d-m-Y')) {
                $result[]=$deal;
            }
        }
        return $result;
    }

    /* 	Получить сделки начало которых СЕГОДНЯ */

    public function getDealsToday()
    {
        if (empty($this->deal_all)) {$this->getAllDeal();}
        $result   =array ();
        $dateToday=new \DateTime('now');
        foreach ($this->deal_all as $deal) {
            $dateStart=new \DateTime($deal->date_start);
            if ($dateToday->format('d-m-Y') == $dateStart->format('d-m-Y')) {
                $result[]=$deal;
            }
        }
        return $result;
    }

    /* Получить товары сделки */

    public function getTovarDeal(int $deal_id)
    {
        if ( ! isset($this->deal_tovars[$deal_id])) {
            $response=$this->request('https://api.myfreshcloud.com/tovar_deal');
            $result  =array ();
            foreach ($response->d->results as $k => $item) {
                $this->deal_tovars[$item->id_deal][]=$item;
            }
        }
        return $this->deal_tovars[$deal_id];
    }

    public function getDocsAll()
    {
        if (empty($this->docs_all)) {
            $response      =$this->request('https://api.myfreshcloud.com/documents?$orderby=data_doc');
            $this->docs_all=$response->d->results;
        }
        return $this->docs_all;
    }

    public function getDocsTypes()
    {
        if (empty($this->docs_types)) {
            $response        =$this->request('https://api.myfreshcloud.com/tip_documents');
            $this->docs_types=$response->d->results;
        }
        return $this->docs_types;
    }

    public function getDocsStatuses()
    {
        if (empty($this->docs_statuses)) {
            $response           =$this->request('https://api.myfreshcloud.com/priznak_documents');
            $this->docs_statuses=$response->d->results;
        }
        return $this->docs_statuses;
    }

    public function getDocTovars(int $id_doc)
    {
        if ( ! isset($this->docs_tovars[$id_doc])) {
            $response=$this->request('https://api.myfreshcloud.com/tovar_doc');
            foreach ($response->d->results as $k => $item) {
                $this->docs_tovars[$item->id_doc][]=$item;
            }
        }
        return $this->docs_tovars[$id_doc];
    }
    
    
    public function getAllProjects()
    {
         if (empty($this->projects_all)) {
             $response=$this->request('https://api.myfreshcloud.com/project');
             $this->projects_all=$response->d->results;
         }
         return $this->projects_all;
    }
    
//    public function getProjectTypes()
//    {
//         if (empty($this->projects_types)) {
//             $response=$this->request('https://api.myfreshcloud.com/list_spr_project_project');
//             var_dump($response);
//             $this->projects_types=$response->d->results;
//         }
//         return $this->projects_types;
//    }
        
    public function getProjectStatuses()
    {
         if (empty($this->projects_statuses)) {
             $response=$this->request('https://api.myfreshcloud.com/priznak_project');
             $this->projects_statuses=$response->d->results;
         }
         return $this->projects_statuses;
    } 
    

    public function sendMessagePost($message, $sender_id, $to_user_id,
                                    int $type_id=1, int $status_id=2)
    {
        $date    =new DateTime('now');
        $post    =array (
            'user_id'   => $to_user_id,
            'sender_id' => $sender_id,
            'text'      => $message,
            'type_id'   => $type_id,
            'status_id' => $status_id,
            'created'   => $date->format('Y-m-d\TH:i:s.u'),
        );
        $response=$this->requestPost("https://api.myfreshcloud.com/messages",
                $post);
        return $response;
    }

    public function sendTaskPost($company_id, $user_id, $creator_id,
                                 $category_id, $type_id, $status_id, $note)
    {
        $dateStart=new DateTime('now');
        $dateEnd  =new DateTime('now');
        $dateEnd  =$dateEnd->modify('+1 day');
        $post     =array (
            /*  ID контрагента	 */
            'company_id'  => $company_id,
            /*  ID пользователя  которому назначена задача */
            'user_id'     => $user_id,
            /*  ID пользователя  который назначил задачу */
            'creator_id'  => $creator_id,
            /*  Дата начала */
            'date_from'   => $dateStart->format('Y-m-d\TH:i:s.u'),
            /*  Дата завершения */
            'date_till'   => $dateEnd->format('Y-m-d\TH:i:s.u'),
            /*  ID категории задачи */
            'category_id' => $category_id,
            /*  ID типа задачи */
            'type_id'     => $type_id,
            /*  ID статуса задачи */
            'status_id'   => $status_id,
            /*  Текст задачи */
            'note'        => $note,
        );
        $response =$this->requestPost("https://api.myfreshcloud.com/tasks",
                $post);
        return $response;
    }

    public function sendTaskPostLeadFORM()
    {
        $params=$this->getParamsNewTaskLeadFORM();
        $this->sendTaskPost($params['company_id'], $params['user_id'],
                $params['creator_id'], $params['category_id'],
                $params['type_id'], $params['status_id'], "ТЕКСТ НОВОЙ ЗАДАЧ");
    }

    protected function request(string $uriString)
    {
        $ch      =curl_init();
        curl_setopt($ch, CURLOPT_URL, $uriString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                array (
            "Content-Type: application/json",
            $this->getAuthHeader()
        ));
        $response=json_decode(curl_exec($ch));
        curl_close($ch);
        if(isset($response->error)){
            throw new \Exception("FO - GET METHOD:".$response->error->message->value);
        }
        return $response;
    }

    protected function requestPost(string $uriString, array $params)
    {
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $uriString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);
        var_dump(json_encode($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));

        curl_setopt($ch, CURLOPT_HTTPHEADER,
                array (
            "Content-Type: application/json;odata=verbose",
            $this->getAuthHeader()
        ));

        $response=json_decode(curl_exec($ch));
        curl_close($ch);
        if(isset($response->error)){
            throw new \Exception("FO- POST METHOD:".$response->error->message->value);
        }
        return $response;
    }

}
