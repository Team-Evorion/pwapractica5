<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', User::class);

        return UserResource::collection(
            User::query()->with('role')->orderBy('name')->paginate(15),
        );
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::query()->create($request->validated());

        return (new UserResource($user->load('role')))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user): UserResource
    {
        Gate::authorize('view', $user);

        return new UserResource($user->load('role'));
    }

    public function update(UpdateUserRequest $request, User $user): UserResource
    {
        $user->update($request->validated());

        return new UserResource($user->refresh()->load('role'));
    }

    public function destroy(User $user): Response
    {
        Gate::authorize('delete', $user);

        if ($user->managedProjects()->exists() || $user->assignedTasks()->exists()) {
            throw ValidationException::withMessages([
                'user' => 'No se puede eliminar un usuario responsable de proyectos o tareas.',
            ]);
        }

        $user->delete();

        return response()->noContent();
    }
}
