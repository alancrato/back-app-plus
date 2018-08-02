<?php

namespace App\Http\Controllers\Admin;

use App\Forms\PromotionForm;
use App\Models\Promotion;
use App\Repositories\PromotionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    /**
     * @var PromotionRepository
     */
    private $repository;

    /**
     * PromotionController constructor.
     * @param PromotionRepository $repository
     */
    public function __construct(PromotionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = $this->repository->paginate();
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(PromotionForm::class, [
            'url' => route('admin.promotions.store'),
            'method' => 'POST'
        ]);
        return view('admin.promotions.create', compact('form'));
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
        $form = \FormBuilder::create(PromotionForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();

        $card = $request->file('card');

        $ext = ['jpg', 'png', 'jpeg'];

        if($card->isValid() and in_array($card->extension(), $ext)){
            $nameFileActive = uniqid(date('YmdHis')).'.'.$card->getClientOriginalExtension();
            $card->storeAs('uploads/promotions/', $nameFileActive);
        }

        $data['card'] = url('/uploads/promotions') .'/'. $nameFileActive;

        $this->repository->create($data);

        $request->session()->flash('message', 'Programação cadastrada com sucesso.');

        return redirect()->route('admin.promotions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Promotion $promotion
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Promotion $promotion)
    {
        return view('admin.promotions.show', compact('promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Promotion $promotion
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Promotion $promotion)
    {
        $form = \FormBuilder::create(PromotionForm::class, [
            'url' => route('admin.promotions.update',['promotions' => $promotion->id]),
            'method' => 'PUT',
            'model' => $promotion
        ]);
        return view('admin.promotions.edit', compact('form'));
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
        $form = \FormBuilder::create(PromotionForm::class, [
            'data' => ['id' => $id]
        ]);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $request->all();

        $card = $request->file('card');

        $ext = ['jpg', 'png', 'jpeg'];

        if($card->isValid() and in_array($card->extension(), $ext)){
            $nameFileActive = uniqid(date('YmdHis')).'.'.$card->getClientOriginalExtension();
            $card->storeAs('uploads/promotions', $nameFileActive);
        }

        $data['card'] = url('/uploads/promotions') .'/'. $nameFileActive;

        $this->repository->update($data,$id);

        $request->session()->flash('message', 'Programação atualizada com sucesso.');

        return redirect()->route('admin.promotions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->repository->delete($id);

        $request->session()->flash('message', 'Programação excluida com sucesso.');

        return redirect()->route('admin.promotions.index');
    }
}
