<?php


namespace ImiApp\MainServer\HttpController;


use Imi\Controller\SingletonHttpController;
use Imi\HttpValidate\Annotation\HttpValidation;
use Imi\JWT\Facade\JWT;
use Imi\Server\Session\Session;
use Imi\Validate\Annotation\Integer;
use Imi\Validate\Annotation\Text;
use Imi\Validate\Annotation\Required;
use Imi\Validate\Annotation\Regex;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Aop\Annotation\Inject;
use Imi\Server\Route\Annotation\Controller;

/**
 * Class RoomController
 * @package ImiApp\MainServer\HttpController
 * @Controller("/Room/")
 */
class RoomController extends SingletonHttpController
{

    /**
     * @Inject("RoomService");
     */
    protected $RoomService;
    /**
     * @Inject("UserSessionService");
     */
    protected $UserSessionService;
    /**
     * @var
     * @Inject("ApiService");
     */
    protected $ApiService;
    /**
     * Date: 2021/5/20
     * Time: 13:48
     * @Action
     * @Route(method="POST");
     * @HttpValidation
     * @Integer(name="roomnumber",mix="1",message="房间号不能为空")
     * @Text(name="title", message="房间标题不能为空")
     * @Text(name="cover", message="房间封面图不能为空")
     * @Text(name="label", message="标签不能为空")
     * @Text(name="introduce", message="简介不能为空")
     * @Text(name="eception", message="接待语不能为空")
     * @Text(name="welcome", message="欢迎语不能为空")
     */
    public function setRoom(
        int $roomnumber,
        string $title,
        string $cover,
        string $eception,
        string $welcome,
        string $label,
        string $introduce ,
        string $blacklist,
        string $password ,
        int $isPush
    ){
        $this->RoomService->setRoom($roomnumber,$title,$cover,$eception,$welcome,Session::get('user_id'),$label,$introduce,$blacklist,$password,$isPush);
    }

    /**
     * Date: 2021/5/20
     * Time: 14:29
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Integer(name="uid",message="人员信息不能为空")
     * @Integer(name="roomnumber",message="房间信息不能为空")
     *
     */
    public function setRoomBlacklist(int $uid,int $roomnumber)
    {
        $this->RoomService->setRoomBlacklist($uid,$roomnumber);
    }

    /**
     * Date: 2021/5/20
     * Time: 14:35
     * @Action
     * @Route(method="POST")
     * @return array
     * 获取自己的房间信息
     */
    public function getRoominfo()
    {
        return [
          'data'=>$this->RoomService->getRoomInfo(Session::get('user_id'))
        ];
    }

    /**
     * Date: 2021/5/20
     * Time: 14:55
     * @Action
     * @Route(method="POST")
     * @return array
     */
    public function getRoomBlacklistInfo()
    {
        return [
            'data'=>$this->RoomService->getRoomBlacklistInfo(Session::get('user_id'))
        ];
    }

    /**
     * Date: 2021/6/16
     * Time: 16:31
     * @Action
     * @Route(method="POST")
     * @return array
     */
    public function getTLSSigAPIv2()
    {
        return [
          'data' => $this->ApiService->genUserSig(Session::get('user_id'))
        ];
    }

    /**
     * Date: 2021/6/21
     * Time: 11:02
     * @Action
     * @Route(method="POST")
     * @param int $roomnumber
     * @param string $bulletin
     * 设置直播间公告栏
     */
    public function setBulletin(int $roomnumber, string $bulletin)
    {
        $this->RoomService->setBulletin($roomnumber,$bulletin,Session::get('user_id'));
    }

    /**
     * Date: 2021/6/21
     * Time: 14:25
     * @Action
     * @Route(method="POST")
     * @param int $roomnumber
     * @return mixed
     */
    public function RoomInfo(int $roomnumber)
    {
        return  [
          'data' =>  $this->RoomService->RoomInfo($roomnumber)
        ];
    }

    /**
     * Date: 2021/6/23
     * Time: 10:39
     * @Action
     * @Route(method="POST")
     * @param int $page
     * @param int $page_size
     * @return array
     */
    public function getRoomGft(int $page,int $page_size)
    {
        return [
          'data' => $this->RoomService->getRoomGft($page,$page_size)
        ];
    }
}