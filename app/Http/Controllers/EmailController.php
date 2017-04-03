<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use PhpImap\Mailbox;
use PhpImap\IncomingMail;
use PhpImap\IncomingMailAttachment;
use App\EmailSetting;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index() {
      // prendo le impostazioni
      $settings = EmailSetting::first();

      // Inizio la connessione Imap
      $mailbox = new Mailbox('{imap.gmail.com:993/imap/ssl}INBOX', 'h57.milano@gmail.com', 'tarantino');

      // Prendo le email e le inserisco in una variabile
      $mailsIds = $mailbox->searchMailbox('ALL');

      foreach ($mailsIds as $key => $mail) {
        $mails[$key] = $mailbox->getMail($mailsIds[$key]);
        // convert date with carbon
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $mails[$key]->date);
        $mails[$key]->date = $date->diffForHumans();
      }

      // dd($mails);

      return view('emails')->with('mails', $mails);
    }
}
