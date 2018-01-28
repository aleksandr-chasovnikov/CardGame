<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseController extends Controller
{
    /**
     * @var BaseRepository
     */
    protected $repository;

    /**
     * @param BaseRepository $repository
     */
    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse | HttpException
     */
    public function store(Request $request)
    {
        // TODO сделать валидацию
//        $this->validate($request->all(), [
//            'set_name' => 'required|max:255',
//        ]);

        $this->repository->create($request);

        return redirect()->back();
    }

    /**
     * @param $id
     *
     * @return Model | null | static
     */
    public function edit($id)
    {
        return $this->repository->withTrashedWhere('id', $id)
            ->first();
    }

    /**
     * Редактирует статью
     *
     * POST /admin/Card/update
     *
     * @param Request $request
     *
     * @return RedirectResponse | HttpException
     */
    public function update(Request $request)
    {
        // TODO сделать валидацию
//        $this->validate($request, [
//            'title' => 'required|max:255',
//        ]);

        $this->repository->withTrashedWhere('id', $request->id)
            ->update(array_except($request->all(), ['_token']));

        return redirect()->back();
    }

    /**
     * @param $id
     *
     * @return RedirectResponse | HttpException
     */
    public function destroy($id)
    {
        $this->repository->getById($id)
            ->delete();

        return redirect()->back();
    }

    /**
     * @param $id
     *
     * @return RedirectResponse | HttpException
     */
    public function forceDestroy($id)
    {
        $this->repository->withTrashedWhere('id', $id)
            ->forceDelete();

        return redirect()->back();
    }

    /**
     * @param $id
     *
     * @return RedirectResponse | HttpException
     */
    public function restore($id)
    {
        $this->repository->withTrashedWhere('id', $id)
            ->restore();

        return redirect()->back();
    }
}
