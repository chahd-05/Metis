<?php

require_once __DIR__ . '/../Core/BaseModel.php';
require_once __DIR__ . '/../Database/Database.php';

class Membre extends BaseModel
{
    protected static string $table = "members";

    protected ?int $id = null;
    private string $full_name;
    private string $email;
    private string $password;

    public function __construct(string $full_name, string $email, string $password)
    {
        $this->setName($full_name);
        $this->setEmail($email);
         $this->setPass($password);
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->full_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPass(): string
    {
        return $this->password;
    }
    public function setName(string $full_name): void
    {
        if (empty($full_name)) {
            throw new Exception("Name is required");
        }
        $this->full_name = $full_name;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("invalid Email ");
        }
    
        if (!$this->emailEstUnique($email)) {
            throw new Exception("Email is already exist");
        }

        $this->email = $email;
    }

    public function setPass(string $password): void
    {
        if (empty($password)) {
            throw new Exception("invalid password ");
        }
    }
    private function emailEstUnique(string $email): bool
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM members WHERE email = :email");
        $stmt->execute(['email' => $email]);

        return $stmt->fetchColumn() == 0;
    }
    public function create(): void
    {
        $this->save([
            'full_name'=> $this->full_name,
            'email'=> $this->email
        ]);
    }
    public static function getAll(): array
    {
        $conn = Database::getConnection();
        $stmt = $conn->query("SELECT * FROM members");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update(): void
    {
        $conn = Database::getConnection();

        $sql = ("UPDATE membre SET full_name = :full_name, email = :email WHERE id = :id");

        $stmt = $conn->prepare($sql);
        $stmt->execute(['full_name'   => $this->full_name,'email' => $this->email,'id'    => $this->id]);
    }
    public static function delete(int $id): void
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare(
            "SELECT COUNT(*) FROM projects WHERE member_id = :id"
        );
        $stmt->execute(['id' => $id]);

        if ($stmt->fetchColumn() > 0) {
            throw new Exception(
                "Can not delete a member has projects!"
            );
        }

        parent::delete($id);
    }
}
