<?php

namespace App\Http\Controllers;

use App\Enums\Type;
use App\Http\Requests\Company\CreateRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->user()->type === Type::EDITOR->value) {
            return Inertia::render('Company/Index', [
                'companies' => Company::paginate(6)
            ]);
        }

        return redirect()->back()->dangerBanner('You don\'t have permission to view this page.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Company/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request, CompanyRepository $companyRepository)
    {
        $companyRepository->create($request->all());

        $request->session()->flash('flash.banner', 'New company was created successfully!');

        return;
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return Inertia::render('Company/Edit', [
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Company $company)
    {
        $company->update($request->all());

        $request->session()->flash('flash.banner', 'Updated successfully!');

        return;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
