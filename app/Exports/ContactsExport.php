<?php

namespace App\Exports;

use App\Contact;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContactsExport implements WithHeadings, WithMapping, FromQuery, WithEvents
{
  public function __construct(int $agent, int $oportunity, int $tag, int $notag)
  {
    $this->agent = $agent;
    $this->oportunity = $oportunity;
    $this->tag = $tag;
    $this->notag = $notag;
  }

  public function query()
  {
    $query = Contact::selectRaw('contacts.*, users.name AS user')->join('users','users.id','contacts.user_id');

    ($this->agent == -2 ) ? $query = $query->whereNULL('contacts.user_id') : '';

    if($this->agent > 0):
        $query = $query->where('contacts.user_id', $this->agent);
    endif;

    if($this->oportunity > 0):
        $query = $query->join('oportunities', 'oportunities.contact_id', '=', 'contacts.id')->where('oportunities.status_id', $this->oportunity);
    endif;

    if($this->tag > 0):
        $query = $query->join('contact_tag', 'contact_tag.contact_id', '=', 'contacts.id')->where('contact_tag.tag_id', $this->tag);
    endif;

    if($this->notag > 0):
        $query = $query->join('contact_tag', 'contact_tag.contact_id', '=', 'contacts.id')->where('contact_tag.tag_id','!=', $this->notag);
    endif;

    return $query;
  }

  public function registerEvents(): array
  {
    return [
      AfterSheet::class    => function(AfterSheet $event) {
        $event->sheet->getDelegate()->getColumnDimension('A')->setAutoSize(true);
        $event->sheet->getDelegate()->getColumnDimension('B')->setAutoSize(true);
        $event->sheet->getDelegate()->getColumnDimension('C')->setAutoSize(true);
        $event->sheet->getDelegate()->getColumnDimension('D')->setAutoSize(true);
        $event->sheet->getDelegate()->getColumnDimension('E')->setAutoSize(true);
        $event->sheet->getDelegate()->getColumnDimension('F')->setAutoSize(true);
        $event->sheet->getDelegate()->getColumnDimension('G')->setAutoSize(true);
        $event->sheet->getDelegate()->getColumnDimension('H')->setAutoSize(true);
        $event->sheet->getDelegate()->getColumnDimension('I')->setAutoSize(true);
        $event->sheet->getDelegate()->getColumnDimension('J')->setAutoSize(true);

        $cellRangeHeaders = 'A1:J1'; // All headers
        $event->sheet->getDelegate()->getStyle($cellRangeHeaders)->getFont()->setSize(13);
        $event->sheet->getDelegate()->getStyle($cellRangeHeaders)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCCCC');
      },
    ];
  }


  public function map($map): array
  {
    return [
      $map->name,
      $map->email,
      $map->phone_1,
      $map->phone_2,
      $map->direction,
      $map->province,
      $map->ContactStringTags(),
      $map->user,
      $map->created_at,
      $map->updated_at,
    ];
  }

  public function headings(): array
  {
    return [
      'Nombre',
      'Email',
      'Teléfono 1',
      'Teléfono 2',
      'Dirección',
      'Provincia',
      'Etiquetas',
      'Agente',
      'Create',
      'Actualizado',
    ];
  }
}
