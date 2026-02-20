<?php
namespace App\Services;
use Exception;
use Illuminate\Support\Facades\DB;
class UserService
{
    public function __construct()
    {

    }
    public function uploadcsv($params = [])
    {
        $RES = ["status" => false, "status_key" => "INVALID_RESPONSE", "status_code" => 400, "message" => "invalid api response"];
        try {
            $file = $params['csv_file'];
            if (($handler = fopen($file->getRealPath(), 'r')) != false) {
                $invalid = [];
                $validprocess = [];
                while (($row = fgetcsv($handler)) != false) {
                    [$userid, $username, $email, $password] = $row;
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {

                        $pdo = DB::connection()->getPdo();
                        $sql = "INSERT INTO tbl_user (`user_id`,`username`,`password`,`email`,`created_at`) VALUES(:user_id,:username,:password,:email,:date)";
                        $stmt = $pdo->prepare($sql);
                        $result = $stmt->execute([
                            ":user_id" => $userid,
                            ":username" => $username,
                            ":password" => bcrypt($password),
                            ":email" => $email,
                            ":date" => now()
                        ]);
                        if ($result) {
                            $validprocess[] = $row;
                        }
                    } else
                        $invalid[] = $row;
                }

                $RES = ["status" => true, "status_key" => "SUCCES", "status_code" => 200, "message" => "data proccessed successfully", "data" => ["invalid" => $invalid, "valid" => $validprocess]];

            } else
                $RES = ["status" => false, "status_key" => "ERROR", "status_code" => 400, "message" => "unable to open file"];
            return $RES;
        } catch (Exception $e) {
            return $RES = ["status" => false, "status_key" => "ERROR", "status_code" => 400, "message" => $e->getMessage()];
        }

    }
}