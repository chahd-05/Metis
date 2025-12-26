<?php

require_once __DIR__ . '/../Core/BaseModel.php';
require_once __DIR__ . '/../Database/Database.php';

class Activity extends BaseModel
{
    protected static string $table = "activity";

    protected ?int $id = null;
    private string $activity_name;
    private string $description;
    private int $project_id;
    private string $activity_date;

    public function __construct(string $activity_name, string $description, int $project_id)
    {
        $this->activity_name = $activity_name;
        $this->setdescription($description);
        $this->project_id = $project_id;
        $this->activity_date = date('Y-m-d H:i:s');
    }
    public function setdescription(string $description): void
    {
        if (empty($description)) {
            throw new Exception("Description is required");
        }
        $this->description = $description;
    }
    public function create(): void
    {
        $this->save([
            'activity_name'=> $this->activity_name,
            'description'=> $this->description,
            'project_id'=> $this->project_id,
            'activity_date'=> $this->activity_date
        ]);
    }
    public function update(): void
    {
        $conn = Database::getConnection();

        $sql = ("UPDATE activity SET activity_name = :activity_name, description = :description WHERE id = :id");
        $stmt = $conn->prepare($sql);
        $stmt->execute(['activity_name'=> $this->activity_name, 'description'=> $this->description,'id'=> $this->id]);
    }
    public static function delete(int $id): void
    {
        parent::delete($id);
    }
    public static function getByActivity(int $project_id): array
    {
        $conn = Database::getConnection();
 
        $stmt = $conn->prepare("SELECT * FROM activity WHERE project_id = :project_id ORDER BY activity_date DESC");
        $stmt->execute(['project_id' => $project_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
