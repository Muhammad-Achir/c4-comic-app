<?php

namespace App\Controllers;

use App\Models\ComicModel;

class Comics extends BaseController
{
    protected $comicModel;
    public function __construct()
    {
        $this->comicModel = new ComicModel();
    }

    public function index()
    {
        // $comic = $this->comicModel->findAll();
        // dd($comic);

        $data = [
            'tittle' => 'Daftar Komic',
            'comic' => $this->comicModel->getComic()
        ];

        // connect to db without model
        // $db = \Config\Database::connect();
        // $comic = $db->query("SELECT * FROM comic");
        // foreach ($comic->getResultArray() as $row) {
        //     d($row);
        // }

        // connect to db with model
        // $comicModel = new \App\Models\ComicModel();


        return view('comics/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'tittle' => 'Detail Comic',
            'comic' => $this->comicModel->getComic($slug)
        ];

        // if comic is empty
        if (empty($data['comic'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Tittle comic ' . $slug . ' is not found!');
        }

        return view('comics/detail', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'tittle' => 'Form Add New Data',
            'validation' => \Config\Services::validation()
        ];

        return view('comics/create', $data);
    }

    public function save()
    {
        // input validation
        if (!$this->validate([
            // 'judul' => 'required|is_unique[comic.judul]'

            'judul' => [
                'rules' => 'required|is_unique[comic.judul]',
                'errors' => [
                    'required' => '{field} Comic wajib di isi',
                    'is_unique' => '{field} Comic tidak boleh sama'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/comics/create')->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->comicModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('message', 'Data success added');

        return redirect()->to('/comics');
    }

    public function delete($id)
    {
        $this->comicModel->delete($id);
        session()->setFlashdata('message', 'Data success deleted');
        return redirect()->to('/comics');
    }

    public function edit($slug)
    {
        $data = [
            'tittle' => 'Form Edit New Data',
            'validation' => \Config\Services::validation(),
            'comic' => $this->comicModel->getComic($slug)
        ];

        return view('comics/edit', $data);
    }

    public function update($id)
    {
        // check judul
        $oldComic = $this->comicModel->getComic($this->request->getVar('slug'));

        if ($oldComic['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[comic.judul]';
        }

        // input validation
        if (!$this->validate([
            // 'judul' => 'required|is_unique[comic.judul]'

            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} Comic wajib di isi',
                    'is_unique' => '{field} Comic tidak boleh sama'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/comics/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->comicModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('message', 'Data success chaged');

        return redirect()->to('/comics');
    }
}
