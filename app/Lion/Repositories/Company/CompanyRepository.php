<?php namespace Lion\Repositories\Company;

use Lion\Repositories\Tenant\TenantRepository as T;

class CompanyRepository extends T implements CompanyRepositoryInterface {

    // Element entity path
    protected $entity = 'Lion\Company';

    // Entity dependences
    protected $dependences = array('Deals', 'People', 'Status', 'BillingHistory');

    // Entity validation
    protected $validators = array(
            'Lion\Services\Validators\Company\CompanyValidator',
            // 'Lion\Services\Validators\Account\SuspendedAccountValidator',
        );

    // Entity listeners
    protected $listeners = array(
        'Lion\Listeners\Company\CompanyListener'
    );

    // Owned and created auto fill
    protected $createdAndOwnedBy = true;

    /**
     * Stores a new Company object into the database.
     * 
     * @param  Array  $data
     * @return Entity
     */
    public function store(Array $data)
    {
        $company = parent::store($data);

        $this->storeBilling($company, $data);

        return $company;
    }

    /**
     * Updates a Company object into the database
     * 
     * @param  Array  $data
     * @return Entity
     */
    public function update($id, Array $data)
    {
        $company = parent::update($id, $data);

        $this->storeBilling($company, $data);

        return $company;      
    }

    /**
     * Stores the Company billing
     * 
     * @param  Entiti $company 
     * @param  array  $data
     */
    protected function storeBilling($company, Array $data)
    {
        $company->billingHistory()->delete();

        if (isset($data['bill']))
        {

            foreach ($data['bill'] as $bill)
            {
                if (empty($bill['year']) || empty($bill['amount']))
                    continue;

                $billItem = new \Lion\CompanyBilling(array(
                        'year'          => $bill['year'],
                        'amount'        => $bill['amount'],
                        'company_id'    => $company->id
                    )
                );

                $billItem->save();
            }
        }
    }

    /**
     * [trash description]
     * @return [type] [description]
     */
    public function trash()
    {

    } 
}