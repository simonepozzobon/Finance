<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use PhpImap\Mailbox;
use PhpImap\IncomingMail;
use PhpImap\IncomingMailAttachment;
use App\EmailSetting;
use App\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index() {

      // prendo le impostazioni
      $settings = EmailSetting::first();

      // Inizio la connessione Imap
      $mailbox = new Mailbox('{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX', 'h57.milano@gmail.com', 'tarantino');

      // Prendo le email e le inserisco in una variabile
      $mailsIds = $mailbox->searchMailbox('ALL');

      // foreach ($mailsIds as $key => $mail) {
      //   $mails[$key] = $mailbox->getMail($mailsIds[$key]);
      //   // convert date with carbon
      //   $date = Carbon::createFromFormat('Y-m-d H:i:s', $mails[$key]->date);
      //   $mails[$key]->date = $date->diffForHumans();
      // }

      $mails = $mailbox->getMailsInfo($mailsIds);
      foreach ($mails as $key => $mail) {
        // convert date with carbon
        $date = date('Y-m-d H:i:s', strtotime($mails[$key]->date));
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
        $mails[$key]->date = $date->diffForHumans();
      }

      // Whitout folder in the first option
      $mailbox_folders = new Mailbox('{imap.gmail.com:993/imap/ssl/novalidate-cert}', 'h57.milano@gmail.com', 'tarantino');
      $folders = $mailbox_folders->getListingFolders();

      $model = new Email;
      $nice_folders = $model->niceFolders($folders, false);

      return view('emails')->with('email_folders', $folders)->with('nice_email_folders', $nice_folders)->with('mails', $mails);
    }
}
