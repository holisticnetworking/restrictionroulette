<?php
// src/Controller/RestrictionRouletteController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RestrictionRouletteController extends AbstractController
{
	private $restrictions = [
		'Instrumentation' => [
			'Use only percussion',
			'No piano allowed',
			'String instruments only'
		],
		'Structure' => [
			'Write in a palindrome form',
			'Must start with silence',
			'Four 8-bar phrases'
		],
		'Harmony' => [
			'Use only minor chords',
			'Avoid using triads',
			'Resolve to a non-tonic chord'
		],
		'Rhythm' => [
			'Compose in 5/4',
			'Include no eighth notes',
			'Syncopation required in every measure'
		],
		'Style/Genre' => [
			'Imitate Baroque style',
			'Compose for a horror soundtrack',
			'Minimalist approach'
		],
		'Melody' => [
			'Write without a main melody',
			'Limit range to one octave',
			'Use only ascending intervals'
		]
	];

	#[Route('/roulette/spin', name: 'spin_roulette', methods: ['GET'])]
	public function spin(): JsonResponse
	{
		// Randomly select one restriction from each category
		$selectedRestrictions = [];
		foreach ($this->restrictions as $category => $options) {
			$selectedRestrictions[$category] = $options[array_rand($options)];
		}

		return new JsonResponse($selectedRestrictions);
	}

	#[Route('/roulette', name: 'show_roulette', methods: ['GET'])]
	public function show(): Response
	{
		return $this->render('roulette.html.twig');
	}
}