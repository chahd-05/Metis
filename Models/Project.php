<?php

require_once __DIR__ . '/../Core/BaseModel.php';

abstract class Project extends BaseModel
{
    protected static string $table = "projects";

    protected ?int $id = null;
    protected string $project_title;
    protected int $member_id;

    public function __construct(string $project_title, int $member_id)
    {
        $this->project_title = $project_title;
        $this->member_id = $member_id;
    }
    abstract public function getType(): string;

    public function getProjectTitle(): string
    {
        return $this->project_title;
    }

    public function getIdMember(): int
    {
        return $this->member_id;
    }
    public function create(): void
    {
        $this->save(['project_title'=> $this->project_title,'member_id'=> $this->member_id,'project_type'=> $this->getType()]);
    }
    public static function getByProjet(int $member_id): array
    {
        $conn = Database::getConnection();

        $stmt = $conn->prepare("SELECT * FROM projects WHERE member_id = :member_id ORDER BY project_title DESC");
        $stmt->execute(['member_id' => $member_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
