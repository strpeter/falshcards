<?php

namespace Falshcards\FalshcardsBundle\Controller;

use
	Symfony\Bundle\FrameworkBundle\Controller\Controller,
	Symfony\Component\HttpFoundation\Response,
	Falshcards\FalshcardsBundle\Entity\Card,
	Falshcards\FalshcardsBundle\Entity\Folder
;

class CardController extends Controller
{
	// gibt das Home-Template aus
	public function homeAction() {
		return $this->render('FalshcardsBundle:Card:home.html.twig');
	}
	
	// gibt die Form aus, um Karten hinzuzufuegen
	public function showAddCardAction() {
		// alle Ordner aus der Datenbank holen
		$folders = $this->getDoctrine()->getRepository('FalshcardsBundle:Folder')->findAll();

        // wurde ein 'folder' als GET Argument übergeben? (z.B. mit http://10.0.1.43/falshcards/ProjectK/Symfony/web/app_dev.php/falshcards/addcard?folder=3)
        $idfolder = null;
        if ($this->getRequest()->query->has('folder')) {
            // falls das 'folder' Argument eine positive Ganzzahl (Integer) ist..
            if (filter_var($this->getRequest()->query->get('folder'), FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)))) {
                $idfolder = $this->getRequest()->query->get('folder');
            }
        }
        return $this->render('FalshcardsBundle:Card:addcardform.html.twig', array('folders' => $folders, 'idfolder' => $idfolder));
	}
	
	// speichert die hinzugefuegte Karte in der DB
	public function saveAddCardAction() {
		// den HTTP Request in eine Variable holen
		$request = $this->getRequest();
		
		// wurde ich mit POST aufgerufen?
		if ($request->getMethod() == 'POST') {
			// wenn ja
			// leere neue Karte erstellen
			$card = new Card();
			
			// Frage und Antwort und Ordner aus dem Formular in das Objekt speichern
			$card->setQuestion($request->request->get('question'));
			$card->setAnswer($request->request->get('answer'));
			$folder = $this->getDoctrine()->getRepository('FalshcardsBundle:Folder')->find($request->request->get('folder'));
			if (!$folder)
				trigger_error('Der ausgewaehlte Ordner konnte nicht gefunden werden!');
			$card->setffolder($folder);
			
			// das Objekt $card in der Datenbank speichern
			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($card);
			$em->flush();
			
			// vielen dank anzeigen
			return $this->render('FalshcardsBundle:Card:addcardform-dank.html.twig', array('idfolder' => $folder->getIdfolder()));
		} else {
			// wenn nein -> fehler!
			trigger_error('Das muss mit einem HTTP POST aufgerufen werden!');
		}
	}
	
	// gibt die Form aus, um Karten zu aendern
	public function showChangeCardAction($id_card) {
		// alle Ordner aus der Datenbank holen
		$folders = $this->getDoctrine()->getRepository('FalshcardsBundle:Folder')->findAll();
		
		// karte aus der DB holen
		$card = $this->getDoctrine()->getRepository('FalshcardsBundle:Card')->find($id_card);
		if (!$card)
			trigger_error('Karte nicht gefunden!');
		return $this->render('FalshcardsBundle:Card:changecardform.html.twig', array('card' => $card, 'folders' => $folders));
	}
    
	// speichert die geaenderte Karte in der DB
	public function saveChangeCardAction($id_card) {
		// den HTTP Request in eine Variable holen
		$request = $this->getRequest();
		
		// wurde ich mit POST aufgerufen?
		if ($request->getMethod() == 'POST') {
			// wenn ja
			// Karte aus der DB holen
			$card = $this->getDoctrine()->getRepository('FalshcardsBundle:Card')->find($id_card);
			if (!$card)
				trigger_error('Karte nicht gefunden!');
			
			// Frage und Antwort und Ordner aus dem Formular in das Objekt speichern
			$card->setQuestion($request->request->get('question'));
			$card->setAnswer($request->request->get('answer'));
			$folder = $this->getDoctrine()->getRepository('FalshcardsBundle:Folder')->find($request->request->get('folder'));
			if (!$folder)
				trigger_error('Der ausgewaehlte Ordner konnte nicht gefunden werden!');
			$card->setffolder($folder);
			
			// das Objekt $card in der Datenbank speichern
			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($card);
			$em->flush();
			
			// vielen dank anzeigen
			return $this->render('FalshcardsBundle:Card:changecardform-dank.html.twig');
		} else {
			// wenn nein -> fehler!
			trigger_error('Das muss mit einem HTTP POST aufgerufen werden!');
		}
	}
	
	// gibt die Form aus, um Ordner hinzuzufuegen
	public function showAddFolderAction() {
		return $this->render('FalshcardsBundle:Card:addfolderform.html.twig');
	}
	
	// speichert den neuen Ordner
	public function saveAddFolderAction() {
		// den HTTP Request in eine Variable holen
		$request = $this->getRequest();
		
		// wurde ich mit POST aufgerufen?
		if ($request->getMethod() == 'POST') {
			// wenn ja
			// leeren neuen Ordner erstellen
			$folder = new Folder();
			
			// Frage und Antwort aus dem Formular in das Objekt speichern
			$folder->setName($request->request->get('name'));
			
			// das Objekt $folder in der Datenbank speichern
			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($folder);
			$em->flush();
			
			// vielen dank anzeigen
			return $this->render('FalshcardsBundle:Card:addfolderform-dank.html.twig', array('idfolder' => $folder->getIdfolder()));
		} else {
			// wenn nein -> fehler!
			trigger_error('Das muss mit einem HTTP POST aufgerufen werden!');
		}
	}
	
	// zeigt alle Ordner an
	public function showFoldersAction() {
		// alle Ordner aus der Datenbank holen
		$folders = $this->getDoctrine()->getRepository('FalshcardsBundle:Folder')->findAll();
		return $this->render('FalshcardsBundle:Card:showfolders.html.twig', array('folders' => $folders));
	}
	
	// zeigt alle Karten in einem Ordner an
	public function showCardsAction($id_folder) {
		// ordner aus der DB holen
		$folder = $this->getDoctrine()->getRepository('FalshcardsBundle:Folder')->find($id_folder);
		if (!$folder)
			trigger_error('Ordner nicht gefunden!');

		// karten des ordners aus der DB holen
		$cards = $this->getDoctrine()->getRepository('FalshcardsBundle:Card')->findBy(array('ffolder' => $folder));
		return $this->render('FalshcardsBundle:Card:showcards.html.twig', array('folder' => $folder, 'cards' => $cards));
	}
	
	// exportiert einen Ordner als PDF
	public function exportCardAction($id_folder) {
		// $base_path zeigt auf Symfony/web im lokalen (=Server) Dateisystem
		$base_path = $this->get('kernel')->getRootDir();;
		$tex_path = $base_path.'/../web/tex/';

		// der Dateinamen besteht aus IP und einer Randomzahl durch SHA1 gelassen
		$tex_file = sha1($this->getRequest()->server->get('REMOTE_ADDR').rand());
		$pdf_file = $tex_file.'.pdf';
		$log_file = $tex_file.'.log';
		
		// tex, pdf und log dateien loeschen
		if (file_exists($tex_path.$tex_file.'.tex')) unlink($tex_path.$tex_file.'.tex');
		if (file_exists($tex_path.$pdf_file)) unlink($tex_path.$pdf_file);
		if (file_exists($tex_path.$log_file)) unlink($tex_path.$log_file);		

        // alle Karten zum Ordner aus der Datenbank holen
        $cards = $this->getDoctrine()->getRepository('FalshcardsBundle:Card')->findBy(array('ffolder' => $id_folder));
        // wurden überhaupt Karten gefunden?
        if (!$cards) {
            trigger_error('Keine Karten in diesem Ordner gefunden!');
        }

		// ordner aus der DB holen
		$folder = $this->getDoctrine()->getRepository('FalshcardsBundle:Folder')->find($id_folder);
		if (!$folder) {
			trigger_error('Ordner nicht gefunden!');
		}
		
		// tex-datei schreiben
		$fh = fopen($tex_path.$tex_file.'.tex', 'w') or die("can't open file");
		$tex = $this->renderView('FalshcardsBundle:Card:export.tex.twig', array('cards' => $cards, 'folder' => $folder));
		fwrite($fh, $tex);
		fclose($fh);
		
		// tex datei kompilieren
		$response = exec('cd '.$tex_path.'; pdflatex '.$tex_file.'.tex > error.txt');
		
		// existiert das PDF-file?
		if (file_exists($tex_path.$pdf_file)) {
			return $this->redirect($this->get('request')->getBasePath().'/tex/'.$pdf_file);
		} else {
			//Zeige die Datei ProjectK/Symfony/web/error.txt als plaintext
			return $this->render('FalshcardsBundle:Card:erroroccured.html.twig', array('errorlog' => file_get_contents($tex_path.'error.txt')));
		}
	}
}
