<?php

namespace App\Repository;

interface StudentRepositoryInterface{


    // Get Add Form Student
    public function Get_Student();
    public function Edit_Student($id);

    //Update_Student
    public function Update_Student($request);

    //Delete_Student
    public function Delete_Student($request);
    public function Create_Student();

    // Get classrooms
    public function Get_grade($id);

    //Get Sections
    public function Get_Sections($id);

    //Store_Student
    public function Store_Student($request);

}