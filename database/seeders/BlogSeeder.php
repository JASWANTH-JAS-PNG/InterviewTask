<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'category' => 'admit-card',
                'title'    => 'SSC CGL 2024 Admit Card Released – Download Now',
                'excerpt'  => 'The Staff Selection Commission has released the SSC CGL 2024 Tier 1 admit card. Candidates can download their hall ticket from the official website.',
                'content'  => "The Staff Selection Commission (SSC) has officially released the SSC CGL 2024 Tier 1 Admit Card on its official website. Candidates who have registered for the Combined Graduate Level examination can download their admit card by visiting ssc.nic.in.\n\nHow to Download SSC CGL Admit Card:\n1. Visit the official SSC website at ssc.nic.in\n2. Click on the \"Admit Card\" section on the homepage\n3. Select \"SSC CGL 2024 Tier 1 Admit Card\"\n4. Enter your registration number and date of birth\n5. Click Submit to view and download your admit card\n6. Take a printout for future reference\n\nThe SSC CGL 2024 Tier 1 exam is scheduled to be held across various centers throughout India. Candidates must carry a printed copy of the admit card along with a valid photo ID proof to the exam center.\n\nImportant Dates:\n- Admit Card Release Date: Available Now\n- Exam Date: As per schedule\n- Result Date: To be announced\n\nFor any queries regarding the admit card, candidates can contact the SSC regional offices.",
                'date'     => '2024-03-15',
            ],
            [
                'category' => 'result',
                'title'    => 'UPSC Civil Services Prelims 2024 Result Declared',
                'excerpt'  => 'UPSC has declared the Civil Services Preliminary Examination 2024 result. Qualified candidates are eligible to appear for the Mains examination.',
                'content'  => "The Union Public Service Commission (UPSC) has declared the result of the Civil Services Preliminary Examination 2024. Candidates who appeared in the examination can check their result on the official UPSC website at upsc.gov.in.\n\nHow to Check UPSC Prelims Result:\n1. Visit upsc.gov.in\n2. Navigate to the \"What's New\" section\n3. Click on the Civil Services Preliminary Examination 2024 Result link\n4. Download the PDF containing the roll numbers of qualified candidates\n5. Search for your roll number in the list\n\nThis year, a total of approximately 4,50,000 candidates appeared for the Civil Services Prelims examination held in June 2024. The qualified candidates will now be eligible to appear for the Civil Services Main Examination.\n\nKey Statistics:\n- Total Vacancies: 1056\n- Approximate Candidates Qualified: 14,000+\n- Cut-off marks will be released after the final result\n\nQualified candidates should start their preparation for the Mains examination immediately. The Mains examination will be conducted in September 2024.",
                'date'     => '2024-07-10',
            ],
            [
                'category' => 'sarkari-job',
                'title'    => 'Railway Recruitment 2024: 11,558 Vacancies for Group D Posts',
                'excerpt'  => 'Indian Railways has announced 11,558 vacancies for Group D posts. Eligible candidates can apply online before the last date.',
                'content'  => "The Railway Recruitment Board (RRB) has released a massive recruitment notification for 11,558 Group D posts across various railway zones in India. This is a golden opportunity for candidates looking for a stable government job in the railway sector.\n\nVacancy Details:\n- Total Posts: 11,558\n- Post Name: Track Maintainer, Gateman, Pointsman, Helper in Engineering/Electrical/Mechanical/S&T Departments\n- Pay Scale: Level 1 (Rs. 18,000 - 56,900)\n\nEligibility Criteria:\n- Educational Qualification: 10th pass (Matriculation) from a recognized board\n- Age Limit: 18 to 33 years (relaxation applicable for reserved categories)\n- Physical Standard: As per RRB norms\n\nApplication Process:\n1. Visit the official RRB website of your region\n2. Click on \"Apply Online\" for Group D Recruitment 2024\n3. Register with your email and mobile number\n4. Fill in the application form with correct details\n5. Upload required documents\n6. Pay the application fee and submit\n\nImportant Dates:\n- Notification Date: Available Now\n- Application Start Date: To be announced\n- Last Date to Apply: To be announced\n- Exam Date: To be announced\n\nCandidates are advised to regularly check the official RRB website for updates.",
                'date'     => '2024-05-20',
            ],
            [
                'category' => 'syllabus',
                'title'    => 'SSC CHSL 2024 Syllabus: Complete Guide for Tier 1 & Tier 2',
                'excerpt'  => 'Detailed syllabus for SSC CHSL 2024 examination covering Tier 1 and Tier 2. Know all topics and marking scheme.',
                'content'  => "The Staff Selection Commission has released the detailed syllabus for SSC CHSL (Combined Higher Secondary Level) 2024 Examination. Candidates preparing for this examination must know the complete syllabus to plan their study schedule effectively.\n\nSSC CHSL Tier 1 Syllabus:\n\n1. English Language (25 Questions, 50 Marks)\n- Spot the Error\n- Fill in the Blanks\n- Synonyms/Antonyms\n- Spelling/Detecting Misspelled Words\n- Idioms & Phrases\n- One Word Substitution\n- Improvement of Sentences\n- Active/Passive Voice\n- Direct/Indirect Narration\n- Comprehension Passage\n\n2. General Intelligence (25 Questions, 50 Marks)\n- Analogies\n- Similarities and Differences\n- Space Visualization\n- Spatial Orientation\n- Problem Solving\n- Analysis and Judgment\n- Decision Making\n- Visual Memory\n- Discrimination and Observation\n\n3. Quantitative Aptitude (25 Questions, 50 Marks)\n- Number System\n- Computation of Whole Numbers\n- Decimals and Fractions\n- Relationship Between Numbers\n- Fundamental Arithmetical Operations\n- Percentages, Ratio and Proportion\n- Square Roots, Averages, Interest\n- Profit and Loss, Discount\n- Time and Distance, Time and Work\n\n4. General Awareness (25 Questions, 50 Marks)\n- Current Events of National and International Importance\n- History of India\n- Geography\n- Economic and Social Development\n- Environmental Ecology\n- General Science\n\nSSC CHSL Tier 2 Syllabus will include a descriptive paper with essay writing and letter writing.",
                'date'     => '2024-02-28',
            ],
            [
                'category' => 'answer-key',
                'title'    => 'IBPS PO 2024 Preliminary Exam Answer Key Released',
                'excerpt'  => 'IBPS has released the provisional answer key for PO Preliminary Examination 2024. Candidates can raise objections till the specified date.',
                'content'  => "The Institute of Banking Personnel Selection (IBPS) has released the provisional answer key for the IBPS PO (Probationary Officer) Preliminary Examination 2024. Candidates who appeared in the exam can now check and download the answer key from the official IBPS website.\n\nHow to Download IBPS PO Answer Key:\n1. Visit the official website: ibps.in\n2. Click on \"CRP PO/MT\" section\n3. Look for the answer key link\n4. Login using your registration number and password\n5. Download the answer key PDF\n\nObjection Window:\nCandidates who disagree with any answer in the official answer key can raise objections during the objection window period. Each objection requires a fee of Rs. 100 per question challenged.\n\nHow to Raise Objection:\n1. Login to IBPS portal\n2. Navigate to the answer key objection section\n3. Select the question and provide correct answer with justification\n4. Attach supporting documents (study material, books)\n5. Pay the objection fee online\n6. Submit the objection\n\nImportant Points:\n- Answer key objections will be reviewed by subject experts\n- If an objection is found valid, the answer key will be updated\n- The fee will be refunded for valid objections\n- Final answer key will be released after reviewing all objections\n\nThe IBPS PO Main Examination will be conducted for candidates who qualify the Preliminary Examination.",
                'date'     => '2024-10-05',
            ],
            [
                'category' => 'admit-card',
                'title'    => 'NEET UG 2024 Admit Card: Download Hall Ticket from NTA',
                'excerpt'  => 'National Testing Agency (NTA) has released the NEET UG 2024 admit card. Medical aspirants can download their hall ticket from neet.ntaonline.in.',
                'content'  => "The National Testing Agency (NTA) has released the NEET UG 2024 Admit Card on its official website. All candidates registered for the National Eligibility cum Entrance Test (Undergraduate) can now download their hall ticket from neet.ntaonline.in.\n\nSteps to Download NEET UG 2024 Admit Card:\n1. Go to neet.ntaonline.in\n2. Click on the \"Download Admit Card\" link\n3. Enter your Application Number\n4. Enter your Date of Birth\n5. Enter the security pin\n6. Click on \"Sign In\"\n7. Your admit card will appear on the screen\n8. Download and print multiple copies\n\nDocuments to Carry on Exam Day:\n- NEET UG 2024 Admit Card (printed)\n- Any one valid photo identity proof (Aadhaar, Passport, Driving License, etc.)\n- Passport size photograph (same as uploaded in application)\n- PwD certificate (if applicable)\n\nExam Day Guidelines:\n- Report to exam center 2 hours before exam time\n- Mobile phones and electronic devices are strictly prohibited\n- Carry transparent water bottle only\n- No colored/fancy dress allowed\n\nThe NEET UG 2024 examination is scheduled to be held in pen-and-paper (OMR) mode across 571 cities in India and 14 cities abroad.",
                'date'     => '2024-04-22',
            ],
        ];

        foreach ($blogs as $data) {
            $category = Category::where('slug', $data['category'])->first();
            if (!$category) continue;

            Blog::firstOrCreate(
                ['slug' => Str::slug($data['title']) . '-seed'],
                [
                    'title'        => $data['title'],
                    'slug'         => Str::slug($data['title']) . '-seed',
                    'excerpt'      => $data['excerpt'],
                    'content'      => $data['content'],
                    'category_id'  => $category->id,
                    'published_at' => $data['date'],
                    'image'        => null,
                ]
            );
        }
    }
}
