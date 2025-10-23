<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institute;
use App\Models\Curriculum;
use App\Models\CurriculumSubject;
use App\Models\ClassModel;

class BeiraUnidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update or create institute information
        Institute::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'BEIRA UNIDA COLÉGIO CRISTÃO',
                'alternate_name_en' => 'Beira United Christian Academy',
                'alternate_name_pt' => 'Colégio Cristão Beira Unida',
                'establish' => '2020',
                'email' => 'director@beiraunida.com',
                'web' => 'www.beiraunida.com',
                'phoneNo' => '(+258) 85 220 3932',
                'address' => 'Samora Machel, Instituto Bíblico de Sofala (IBS), Pioneiros, Sofala, Beira',
                'vision_en' => 'Partnering with the community to provide exceptional, international standard education, where the child is instructed, nurtured and disciplined for a full life: creative and rich in relationship with Christ and neighbour.',
                'vision_pt' => 'Ser parceira da comunidade para providenciar uma educação excepcional de padrão internacional, onde a criança é instruída, nutrida e disciplinada para uma vida plena: criativa e rica no relacionamento com Cristo e com o próximo.',
                'mission_en' => 'Providing what Charlotte Mason called a "Living Education" where every child is guided and empowered to live a full and free life, with God, with themselves, with others and with all creation. We are more concerned with the type of learner each child is becoming than with mastering particular information or techniques, as we believe that a child who has mastered the art of learning will reach their full potential in mastering particular information and techniques. Our mission is accomplished by consistently applying our fundamental beliefs to education.',
                'mission_pt' => 'Fornecer o que Charlotte Mason chamou de "Educação Viva" onde cada criança é orientada e capacitada para viver uma vida plena e livre, com Deus, consigo mesma, com os outros e com toda a criação. Nós nos preocupamos principalmente com o tipo de aluno que cada criança está se tornando do que com o domínio de informações ou técnicas particulares, pois acreditamos que uma criança que domina a arte do aprendizado alcançará todo o seu potencial para dominar informações e técnicas particulares. Nossa missão é cumprida com a aplicação consistente de nossas convicções fundamentais à educação.',
                'motto_en' => 'Shaping Hearts and Minds',
                'motto_pt' => 'Formando corações e mentes',
                'nuit' => '401 866 426',
                'facebook' => 'Beira Unida',
                'logo' => 'beira-unida-logo.png'
            ]
        );

        // Create Curriculums
        $ambleside = Curriculum::firstOrCreate(
            ['name' => 'Ambleside Schools International'],
            ['description' => 'Charlotte Mason based curriculum', 'is_active' => true]
        );

        $cambridge = Curriculum::firstOrCreate(
            ['name' => 'Cambridge'],
            ['description' => 'Cambridge International Curriculum', 'is_active' => true]
        );

        $nacional = Curriculum::firstOrCreate(
            ['name' => 'Curriculum Nacional'],
            ['description' => 'Mozambique National Curriculum', 'is_active' => true]
        );

        // Seed Ambleside Curriculum Subjects
        $amblesideSubjects = [
            ['subject_name' => 'Arithmetic', 'grade_levels' => ['Pré 3^4', 'Pré 5']],
            ['subject_name' => 'Bible', 'grade_levels' => ['Pré 3^4', 'Pré 5', '1ª - 3ª', '4ª - 6ª', '7ª^8ª', '9ª', '10ª^11']],
            ['subject_name' => 'Froebel', 'grade_levels' => ['Pré 5']],
            ['subject_name' => 'Grammar', 'grade_levels' => ['4ª - 6ª']],
            ['subject_name' => 'History', 'grade_levels' => ['1ª - 3ª', '4ª - 6ª']],
            ['subject_name' => 'Language Series', 'grade_levels' => ['Pré 3^4', 'Pré 5']],
            ['subject_name' => 'Literature', 'grade_levels' => ['Pré 5', '1ª - 3ª', '4ª - 6ª', '7ª^8ª']],
            ['subject_name' => 'Phonics & Spelling', 'grade_levels' => ['Pré 5', '1ª - 3ª', '4ª - 6ª']],
            ['subject_name' => 'Poetry', 'grade_levels' => ['Pré 3^4', 'Pré 5']],
            ['subject_name' => 'Practical Life', 'grade_levels' => ['Pré 3^4', 'Pré 5']],
            ['subject_name' => 'Read Aloud', 'grade_levels' => ['Pré 3^4', 'Pré 5', '1ª - 6ª']],
            ['subject_name' => 'Reading', 'grade_levels' => ['Pré 3^4', 'Pré 5', '1ª - 3ª']],
            ['subject_name' => 'Recitation', 'grade_levels' => ['Pré 5', '1ª - 3ª']],
            ['subject_name' => 'Science', 'grade_levels' => ['1ª - 3ª', '4ª - 6ª']],
            ['subject_name' => 'Short story reading', 'grade_levels' => ['Pré 3^4']],
            ['subject_name' => 'Singapore Math', 'grade_levels' => ['1ª - 3ª', '4ª - 6ª']],
            ['subject_name' => 'Transcription & Dictation', 'grade_levels' => ['1ª - 3ª', '4ª - 6ª']],
            ['subject_name' => 'Writing practice', 'grade_levels' => ['Pré 3^4', 'Pré 5', '1ª - 3ª']],
        ];

        foreach ($amblesideSubjects as $subject) {
            CurriculumSubject::firstOrCreate(
                ['curriculum_id' => $ambleside->id, 'subject_name' => $subject['subject_name']],
                $subject
            );
        }

        // Seed Cambridge Curriculum Subjects
        $cambridgeSubjects = [
            ['subject_name' => 'Accounting', 'grade_levels' => ['9ª', '10ª^11']],
            ['subject_name' => 'Biology', 'grade_levels' => ['10ª^11']],
            ['subject_name' => 'Business Studies', 'grade_levels' => ['10ª^11']],
            ['subject_name' => 'Chemistry', 'grade_levels' => ['10ª^11']],
            ['subject_name' => 'English', 'grade_levels' => ['7ª^8ª', '9ª', '10ª^11']],
            ['subject_name' => 'Geography', 'grade_levels' => ['9ª', '10ª^11']],
            ['subject_name' => 'ICT', 'grade_levels' => ['7ª^8ª', '9ª', '10ª^11']],
            ['subject_name' => 'Math', 'grade_levels' => ['7ª^8ª', '9ª', '10ª^11']],
            ['subject_name' => 'Physics', 'grade_levels' => ['10ª^11']],
            ['subject_name' => 'Português', 'grade_levels' => ['10ª^11']],
            ['subject_name' => 'Science', 'grade_levels' => ['7ª^8ª', '9ª']],
        ];

        foreach ($cambridgeSubjects as $subject) {
            CurriculumSubject::firstOrCreate(
                ['curriculum_id' => $cambridge->id, 'subject_name' => $subject['subject_name']],
                $subject
            );
        }

        // Seed Nacional Curriculum Subjects
        $nacionalSubjects = [
            ['subject_name' => 'Ciências Naturais', 'grade_levels' => ['4a']],
            ['subject_name' => 'Ciências Sociais', 'grade_levels' => ['4ª']],
            ['subject_name' => 'Ed Visual e Ofícios', 'grade_levels' => ['Pré 3^4', 'Pré 5', '1ª - 3ª', '4ª - 6ª', '7ª^8ª']],
            ['subject_name' => 'Educação Física', 'grade_levels' => ['Pré 3^4', 'Pré 5', '1ª - 3ª', '4ª - 6ª', '7ª^8ª', '9']],
            ['subject_name' => 'Educação Música', 'grade_levels' => ['Pré 3^4', 'Pré 5', '1ª - 3ª', '4ª - 6ª']],
            ['subject_name' => 'Geografia de Moç.', 'grade_levels' => ['7ª^8ª']],
            ['subject_name' => 'História de Moç.', 'grade_levels' => ['7ª^8ª']],
            ['subject_name' => 'Matemática', 'grade_levels' => ['1ª - 3ª', '4ª - 6ª']],
            ['subject_name' => 'Português', 'grade_levels' => ['1ª - 3ª', '4ª - 6ª', '7ª^8ª', '9']],
        ];

        foreach ($nacionalSubjects as $subject) {
            CurriculumSubject::firstOrCreate(
                ['curriculum_id' => $nacional->id, 'subject_name' => $subject['subject_name']],
                $subject
            );
        }

        // Create Class/Grade levels
        $grades = [
            ['name' => 'Pré 3^4', 'code' => 'PRE34', 'description' => 'Pre-school 3-4 years'],
            ['name' => 'Pré 5', 'code' => 'PRE5', 'description' => 'Pre-school 5 years'],
            ['name' => '1ª - 3ª', 'code' => 'G1-3', 'description' => 'Grade 1-3'],
            ['name' => '4ª - 6ª', 'code' => 'G4-6', 'description' => 'Grade 4-6'],
            ['name' => '7ª^8ª', 'code' => 'G7-8', 'description' => 'Grade 7-8'],
            ['name' => '9ª', 'code' => 'G9', 'description' => 'Grade 9'],
            ['name' => '10ª^11', 'code' => 'G10-11', 'description' => 'Grade 10-11'],
        ];

        foreach ($grades as $grade) {
            ClassModel::firstOrCreate(
                ['code' => $grade['code']],
                $grade
            );
        }

        $this->command->info('Beira Unida data seeded successfully!');
    }
}




