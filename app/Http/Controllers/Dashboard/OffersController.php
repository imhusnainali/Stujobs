<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class OffersController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the offers page
     */
    public function index(Request $request) {
        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->get();

        return view('dashboard/offers/index', ['offers' => $offers]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the offer creation page
     */
    public function createPage()
    {
        $roles = ['company'];

        $companies = DB::table('users')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->whereIn('role', $roles)
            ->select('users.id', 'users.email', 'users.role', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->get();

        return view('dashboard/offers/actions/create', ['companies' => $companies]);
    }

    /**
     * @return mixed
     *
     * Create an offer
     */
    public function create()
    {
        $data = Input::only('create_company_id', 'create_title', 'create_description', 'create_contract_type', 'create_duration', 'create_remuneration', 'create_valid');

        $offer = new Offer();
        $offer->setAttribute('company_id', $data['create_company_id']);
        $offer->setAttribute('title', $data['create_title']);
        $offer->setAttribute('description', $data['create_description']);
        $offer->setAttribute('contract_type', $data['create_contract_type']);
        $offer->setAttribute('duration', $data['create_duration']);
        $offer->setAttribute('remuneration', $data['create_remuneration']);
        $offer->setAttribute('valid', filter_var($data['create_valid'], FILTER_VALIDATE_BOOLEAN));
        $offer->save();

        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->get();

        return view('dashboard/offers/index', ['offers' => $offers]);
    }

    /**
     * @param $id
     *
     * Approve an offer
     */
    public function approve($id)
    {
        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('valid', 1);
        $offer->save();
    }

    /**
     * @param $id
     *
     * Disapprove an offer
     */
    public function disapprove($id)
    {
        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('valid', 0);
        $offer->save();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the offer edit page
     */
    public function editPage($id)
    {
        $offer = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.id as user_id', 'users.role','offers.company_id' , 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->where('offers.id', '=', $id)
            ->get()
            ->first();

        $roles = ['company'];

        $companies = DB::table('users')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->whereIn('role', $roles)
            ->select('users.id', 'users.email', 'users.role', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->get();

        return view('dashboard/offers/actions/edit', ['companies' => $companies, 'offer' => $offer]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Edit an offer
     */
    public function edit($id)
    {
        $data = Input::only('edit_company_id', 'edit_title', 'edit_description', 'edit_contract_type', 'edit_duration', 'edit_remuneration');

        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('company_id', $data['edit_company_id']);
        $offer->setAttribute('title', $data['edit_title']);
        $offer->setAttribute('description', $data['edit_description']);
        $offer->setAttribute('contract_type', $data['edit_contract_type']);
        $offer->setAttribute('duration', $data['edit_duration']);
        $offer->setAttribute('remuneration', $data['edit_remuneration']);
        $offer->save();

        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->get();

        return view('dashboard/offers/index', ['offers' => $offers]);
    }

    /**
     * @param $id
     *
     * Delete an offer
     */
    public function delete($id)
    {
        Offer::where('id', $id)->delete();
    }
//
//    /**
//     * @param $id
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     *
//     * Show a company
//     */
//    public function show($id)
//    {
//        $company = DB::table('users')->where('users.id', $id)
//            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
//            ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.phone', 'companies.address')
//            ->get()
//            ->first();
//
//        return view('dashboard/companies/actions/show', ['company' => $company]);
//    }
}
