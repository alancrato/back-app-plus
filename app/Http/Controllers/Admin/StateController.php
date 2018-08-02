<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\StateRepository;
use App\Forms\StateForm;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * @var StateRepository
     */
    private $repository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * StateController constructor.
     * @param StateRepository $repository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(StateRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    public function states()
    {
        $categories = $this->categoryRepository->all();
        $states = $this->repository->with('categories')->all();
        return view('admin.states.index', compact('states', 'categories'));
    }

    public function index()
    {
        $state = $this->repository->paginate();
        return view('admin.state.index', compact('state'));
    }

    public function create()
    {
        $form = \FormBuilder::create(StateForm::class, [
            'url' => route('admin.state.store'),
            'method' => 'POST'
        ]);
        return view('admin.state.create', compact('form'));
    }

    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(StateForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();

        $this->repository->create($data);

        $request->session()->flash('message', 'Cidade cadastrada com sucesso.');

        return redirect()->route('admin.state.index');
    }

    public function show(State $state)
    {
        return view('admin.state.show', compact('state'));
    }

    public function edit(State $state)
    {
        $form = \FormBuilder::create(StateForm::class, [
            'url' => route('admin.state.update',['state' => $state->id]),
            'method' => 'PUT',
            'model' => $state
        ]);
        return view('admin.state.edit', compact('form'));
    }

    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(StateForm::class, [
            'data' => ['id' => $id]
        ]);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $request->all();

        $this->repository->update($data,$id);

        $request->session()->flash('message', 'Cidade atualizada com sucesso.');

        return redirect()->route('admin.state.index');
    }

    public function destroy(Request $request, $id)
    {
        $this->repository->delete($id);

        $request->session()->flash('message', 'Cidade excluida com sucesso.');

        return redirect()->route('admin.state.index');
    }

}
