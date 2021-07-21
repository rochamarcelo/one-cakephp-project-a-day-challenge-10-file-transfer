<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Transfers Controller
 *
 * @property \App\Model\Table\TransfersTable $Transfers
 * @method \App\Model\Entity\Transfer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransfersController extends AppController
{

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transfer = $this->Transfers->newEmptyEntity();
        if ($this->request->is('post')) {
            $transfer = $this->Transfers->patchEntity($transfer, $this->request->getData());
            $transfer->user_id = $this->request->getAttribute('identity')['id'];
            if ($this->Transfers->save($transfer)) {
                $this->Flash->success(__('The transfer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transfer could not be saved. Please, try again.'));
        }
        $users = $this->Transfers->Users->find('list', ['limit' => 200]);
        $this->set(compact('transfer', 'users'));
    }
}
