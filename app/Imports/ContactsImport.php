<?php

namespace App\Imports;

use App\Contact;
use App\Contact_tag;
use App\Tag;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

use Auth;

class ContactsImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
  use Importable;
  /**
   * @param array $row
   *
   * @return Product|null
   */
  public function model(array $row)
  {
    $contact = Contact::updateOrCreate([
      'user_id' => Auth::user()->id,
      'name' => $row["nombre"],
      'email' => $row["email"],
      'phone_1' => $row["telefono_1"],
      'phone_2' => $row["telefono_2"],
      'direction' => $row["direccion"],
      'province' => $row["provincia"],
    ]);

    $tags = explode(",", $row["etiquetas"]);

    foreach($tags as $tag):
      $t = Tag::where('name', trim($tag))->first();
      if( isset($t->name) ):
        Contact_tag::updateOrCreate([
          'contact_id' => $contact->id,
          'tag_id' => $t->id,
        ]);
      endif;
    endforeach;

    $contact->save();

    return $contact;
  }

  public function chunkSize(): int
  {
      return 500;
  }
}
