<?php

namespace App\Services;

use App\Models\Kurikulum;
use App\Traits\KurikulumTrait;

class KurikulumService {
    use KurikulumTrait;

    public function createKurikulum(Array $data)
    {
        $validated = $this->makeStoreValidator($data)->validate();

        $kurikulum = $this->storeKurikulumInDatabase($validated);

        return $kurikulum;
    }

    public function assignSiswa(Array $data, int $kurikulum_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);

        $validated = $this->makeAssignSiswaValidator($data)->validate();

        $this->assignSiswaToKurikulum($validated, $kurikulum);

        foreach ($kurikulum->pertemuans as $pertemuan) $pertemuan->absensi()->create(["user_id" => $validated["siswa_id"]]);
    }

    public function updateKurikulum(Array $data, int $kurikulum_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);

        $validated = $this->makeUpdateValidator($data)->validate();

        $this->updateKurikulumInDatabase($validated, $kurikulum);

        return $kurikulum->refresh();
    }

    public function addKurikulumResource($data, int $kurikulum_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);

        $validated = $this->makeAddKurikulumResourceValidator($data)->validate();

        $kurikulum->addMedia($validated["file"])
            ->toMediaCollection();

        return $kurikulum;
    }

    public function deleteKurikulumResource(int $kurikulum_id, int $media_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);

        $media = $kurikulum->getMedia()->where("id", $media_id)->first();
        $media->delete();

        return $kurikulum;
    }

    public function createKurikulumPertemuan(Array $data)
    {
        $validated = $this->makeStoreValidator($data)->validate();

        $kurikulum = $this->storeKurikulumInDatabase($validated);

        return $kurikulum;
    }
}
