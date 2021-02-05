<?php

namespace App\Controller;

use App\Repository\CoursesRepository;
use App\Repository\EnrollsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use App\Controller\Elearn_modelController;

class ElearnController extends AbstractController
{
    
	private $session;
	private $elearn_model;
	private $validator;
	
	public function __construct(SessionInterface $session, Elearn_modelController $elearn_model, ValidatorInterface $validator)
    {
		$this->session = $session;
		$this->elearn_model = $elearn_model;
        $this->validator = $validator;
    }
	
		
	/**
     * @Route("/elearn", name="elearn")
     */
    public function index(): Response
    {
        return $this->render('elearn/home.html.twig', [
            'controller_name' => 'index',
        ]);
    }

    /**
     * @Route("/courses", name="courses")
     * @param CoursesRepository $coursesRepository
     * @return Response
     */
    public function view_courses(CoursesRepository $coursesRepository): Response
    {
        $courses = $coursesRepository->findAll();
        return $this->render('elearn/courses.html.twig', [
            'controller_name' => 'courses',
            'courses' => $courses
        ]);
    }


    /**
     * @Route("/messagelogout", name="message_logout")
     * @param CoursesRepository $coursesRepository
     * @return Response
     */
    public function message_logout(CoursesRepository $coursesRepository): Response
    {
        return $this->render('message/message.html.twig', [
            'controller_name' => 'courses',
            'message' => 'Bye bye!'
        ]);
    }


    /**
     * @Route("enroll/{id?}", name="enroll")
     * @param $id
     * @param Request $request
     * @param CoursesRepository $coursesRepository
     * @param EnrollsRepository $enrollsRepository
     * @return Response
     */
    function enroll($id, Request $request,CoursesRepository $coursesRepository, EnrollsRepository $enrollsRepository)
    {
        $user = $this->getUser();
        if ($user == NULL) {
            return $this->redirect($this->generateUrl('app_login'));
        }
        $this->addFlash('success', 'Success!!');
        $course = $coursesRepository->findBy(
            ['id' => $id]
        );
        $enrollsRepository->insertEnroll($user,$course[0]);
        return $this->redirect($this->generateUrl('message_success'));
    }


    /**
     * @Route("myCourses", name="mycourses")
     * @param Request $request
     * @param CoursesRepository $coursesRepository
     * @param EnrollsRepository $enrollsRepository
     * @return Response
     */
    function myCourses(Request $request,CoursesRepository $coursesRepository, EnrollsRepository $enrollsRepository)
    {
        $user = $this->getUser();

        $enroll = $enrollsRepository->findBy(
            ['user' => $user]
        );
        return $this->render('elearn/mycourses.html.twig', [
            'enrolls' => $enroll
        ]);
    }




}
