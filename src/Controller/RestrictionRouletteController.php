<?php
// src/Controller/RestrictionRouletteController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RestrictionRouletteController extends AbstractController
{
	private array $restrictions = [
		'Instrumentation' => [
			'Use only percussion',
			'No piano allowed',
			'String instruments only',
			'Synthesizers only',
			'No bass instruments',
			'All bass instruments',
		],
		'Structure' => [
			'Write in a palindrome form',
			'Must start with silence',
			'Four 8-bar phrases',
			'ABACAB structure',
			'Theme and 4 variations',
		],
		'Harmony' => [
			'Use only minor chords',
			'Use only major chords',
			'Use at least one diminished chord',
			'Avoid using triads',
			'Resolve to a non-tonic chord',
			'Use a non Ionian/Aeolian mode',
		],
		'Rhythm' => [
			'Compose in 5/4',
			'Compose in 7/8',
			'Compose in 3/4',
			'Include no eighth notes',
			'Syncopation required in every measure'
		],
		'Style/Genre' => [
			'Imitate Baroque style',
			'Compose for a horror soundtrack',
			'Minimalist approach',
			'Stylish and modern',
			'Compose for children',
		],
		'Melody' => [
			'Write without a main melody',
			'Limit range to one octave',
			'Use only ascending intervals',
			'Cover a full two-octave range',
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