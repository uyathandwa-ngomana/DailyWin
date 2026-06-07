<?php

namespace App\Services;

use App\Models\TaskAZU;
use App\Repositories\TaskRepositoryAZU;
use Illuminate\Database\Eloquent\Collection;

/**
 * Service layer responsible for task business logic.
 *
 * Acts as an abstraction between controllers and repository layer.
 * Handles task operations such as creation, updates, deletion,
 * and retrieval based on different conditions.
 */
class TaskServiceAZU
{
    protected $taskRepository;

    public function __construct(TaskRepositoryAZU $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Retrieve all tasks.
     */
    public function getAllTasks(): Collection
    {
        return $this->taskRepository->getAllTasks();
    }

    /**
     * Retrieve a single task by ID.
     */
    public function getTaskById(int $id): ?TaskAZU
    {
        return $this->taskRepository->getTaskById($id);
    }

    /**
     * Create a new task.
     */
    public function createTask(array $data): TaskAZU
    {
        return $this->taskRepository->createTask($data);
    }

    /**
     * Update an existing task.
     */
    public function updateTask(int $id, array $data): ?TaskAZU
    {
        return $this->taskRepository->updateTask($id, $data);
    }



    /**
     * Delete a task by ID.
     */
    public function deleteTask(int $id): bool
    {
        return $this->taskRepository->deleteTask($id);
    }


    /**
     * Retrieve tasks created by a specific user.
     */
    public function getTasksCreatedByUser(int $userId): Collection
    {
        return $this->taskRepository->getTasksCreatedByUser($userId);
    }

    /**
     * Retrieve tasks assigned to a specific user.
     */
    public function getTasksAssignedToUser(int $userId): Collection
    {
        return $this->taskRepository->getTasksAssignedToUser($userId);
    }
}
