<?php

namespace App\Http\Controllers\Admin;

use App\Forms\CategoryForm;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {

        $this->repository = $repository;
    }

    public function index()
    {
        $categories = $this->repository->paginate();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(CategoryForm::class, [
            'url' => route('categories.store'),
            'method' => 'POST'
        ]);
        return view('categories.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(CategoryForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();

        $card_active = $request->file('card_active');
        $card_inactive = $request->file('card_inactive');
        $icon = $request->file('icon');

        $ext = ['jpg', 'png', 'jpeg'];

        if($card_active->isValid() and in_array($card_active->extension(), $ext)){
            $nameFileActive = uniqid(date('YmdHis')).'.'.$card_active->getClientOriginalExtension();
            $card_active->storeAs('uploads/cards/active/', $nameFileActive);
        }

        if($card_inactive->isValid() and in_array($card_inactive->extension(), $ext)){
            $nameFileInactive = uniqid(date('YmdHis')).'.'.$card_inactive->getClientOriginalExtension();
            $card_inactive->storeAs('uploads/cards/inactive/', $nameFileInactive);
        }

        if($icon->isValid() and in_array($icon->extension(), $ext)){
            $nameFileIcon = uniqid(date('YmdHis')).'.'.$icon->getClientOriginalExtension();
            $icon->storeAs('uploads/states/icons/', $nameFileIcon);
        }

        $data['card_active'] = url('/uploads/cards/active') .'/'. $nameFileActive;
        $data['card_inactive'] = url('/uploads/cards/inactive') .'/'. $nameFileInactive;
        $data['icon'] = url('/uploads/states/icons') .'/'. $nameFileIcon;

        $this->repository->create($data);

        $request->session()->flash('message', 'Categoria cadastrada com sucesso.');

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Category $category)
    {
        $form = \FormBuilder::create(CategoryForm::class, [
            'url' => route('categories.update',['categories' => $category->id]),
            'method' => 'PUT',
            'model' => $category
        ]);
        return view('categories.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(CategoryForm::class, [
            'data' => ['id' => $id]
        ]);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $request->all();

        $card_active = $request->file('card_active');
        $card_inactive = $request->file('card_inactive');
        $icon = $request->file('icon');

        $ext = ['jpg', 'png', 'jpeg'];

        if($card_active->isValid() and in_array($card_active->extension(), $ext)){
            $nameFileActive = uniqid(date('YmdHis')).'.'.$card_active->getClientOriginalExtension();
            $card_active->storeAs('uploads/cards/active/', $nameFileActive);
        }

        if($card_inactive->isValid() and in_array($card_inactive->extension(), $ext)){
            $nameFileInactive = uniqid(date('YmdHis')).'.'.$card_inactive->getClientOriginalExtension();
            $card_inactive->storeAs('uploads/cards/inactive/', $nameFileInactive);
        }

        if($icon->isValid() and in_array($icon->extension(), $ext)){
            $nameFileIcon = uniqid(date('YmdHis')).'.'.$icon->getClientOriginalExtension();
            $icon->storeAs('uploads/states/icons/', $nameFileIcon);
        }

        $data['card_active'] = url('/uploads/cards/active') .'/'. $nameFileActive;
        $data['card_inactive'] = url('/uploads/cards/inactive') .'/'. $nameFileInactive;
        $data['icon'] = url('/uploads/states/icons') .'/'. $nameFileIcon;

        $this->repository->update($data,$id);

        $request->session()->flash('message', 'Categoria atualizada com sucesso.');

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return Request
     */
    public function destroy(Request $request, $id)
    {
        $this->repository->delete($id);

        $request->session()->flash('message', 'Categoria excluida com sucesso.');

        return redirect()->route('categories.index');
    }

}
