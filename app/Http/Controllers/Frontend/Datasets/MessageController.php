<?php

namespace App\Http\Controllers\Frontend\Datasets;

use App\Models\Messages;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Datasets\MessageRepository;
// use App\Events\Backend\Datasets\Message\MessageDeleted;
use App\Http\Requests\Backend\Datasets\Message\MessageStoreRequest;
use App\Http\Requests\Backend\Datasets\Message\MessageManageRequest;
use App\Http\Requests\Backend\Datasets\Message\MessageUpdateRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class MessageController.
 */
class MessageController extends Controller
{
    /**
     * @var MessageRepository
     */
    protected $repository;

    /**
     * @param MessageRepository       $repository
     */
    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param MessageManageRequest $request
     *
     * @return mixed
     */
    public function index(MessageManageRequest $request)
    {
        return view('frontend.datasets.message.index')
            ->withMessages($this->repository
                ->orderBy('id', 'asc')
                ->paginate(10)
            );
    }

    /**
     * @param MessageManageRequest $request
     *
     * @return mixed
     */
    public function create(MessageManageRequest $request)
    {
        return view('frontend.datasets.message.create');
    }

    /**
     * @param MessageStoreRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(MessageStoreRequest $request)
    {
        $this->repository->create($request->only(
            'from_user_id',
            'to_user_id',
            'advertise_id',
            'subject',
            'message',
            'readed'
        ));

        return redirect()->route('frontend.datasets.message.index')->withFlashSuccess(__('alerts.backend.message.created'));
    }

    /**
     * @param MessageManageRequest $request
     * @param Messages             $message
     *
     * @return mixed
     */
    public function show(MessageManageRequest $request, Messages $message)
    {
        $message->readed = true;
        $message->save();
        //$this->repository->update($message, $request->only('readed'));

        return view('frontend.datasets.message.show')->withMessage($message);
    }

    /**
     * @param MessageManageRequest $request
     * @param Messages             $message
     *
     * @return mixed
     */
    public function edit(MessageManageRequest $request, Messages $message)
    {
        return view('frontend.datasets.message.edit')->withMessage($message);
    }

    /**
     * @param MessageUpdateRequest $request
     * @param Messages             $message
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(MessageUpdateRequest $request, Messages $message)
    {
        $this->repository->update($message, $request->only(
            'from_user_id',
            'to_user_id',
            'advertise_id',
            'subject',
            'message',
            'readed'
        ));

        return redirect()->route('frontend.datasets.message.index')->withFlashSuccess(__('alerts.backend.message.updated'));
    }

    /**
     * @param MessageManageRequest $request
     * @param Messages             $message
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(MessageManageRequest $request, Messages $message)
    {
        $this->repository->deleteById($message->id);

        // TODO event(new MessageDeleted($message));

        return redirect()->route('frontend.datasets.message.index')->withFlashSuccess(__('alerts.backend.message.deleted'));
    }
}
