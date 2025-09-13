<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContentPage;

class ContentPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Business Solutions Page (for option1)
        ContentPage::create([
            'slug' => 'page1',
            'title' => 'Business Solutions & Enterprise Services',
            'description' => 'Welcome to our comprehensive business solutions package! We specialize in helping enterprises scale, optimize their operations, and achieve sustainable growth in today\'s competitive marketplace.

Our team of expert consultants brings decades of combined experience in business strategy, operational excellence, and digital transformation. We work closely with your leadership team to identify opportunities, streamline processes, and implement solutions that drive measurable results.

From startups looking to establish their market presence to Fortune 500 companies seeking to modernize their operations, we have the expertise and resources to support your business objectives.',
            'instructions' => 'NEXT STEPS FOR BUSINESS CLIENTS:

1. INITIAL CONSULTATION (30 minutes - FREE)
   - Schedule a complimentary discovery call with our senior consultant
   - Discuss your current challenges and business objectives
   - Receive a preliminary assessment and recommendations

2. COMPREHENSIVE BUSINESS AUDIT (Week 1-2)
   - In-depth analysis of your current operations
   - Market positioning and competitive analysis
   - Identification of growth opportunities and pain points

3. STRATEGIC PLANNING SESSION (Week 3)
   - Collaborative workshop with your leadership team
   - Development of customized growth strategy
   - Creation of actionable implementation roadmap

4. IMPLEMENTATION SUPPORT (Ongoing)
   - Dedicated project manager assigned to your account
   - Regular progress reviews and strategy adjustments
   - Access to our full suite of business tools and resources

5. PERFORMANCE MONITORING (Monthly)
   - KPI tracking and performance analytics
   - Monthly strategy review meetings
   - Continuous optimization recommendations

CONTACT INFORMATION:
- Business Development: (555) 123-4567
- Email: business@company.com
- Emergency Support: Available 24/7 for enterprise clients

WHAT TO PREPARE:
- Current business plan or strategic documents
- Recent financial statements (last 2 years)
- Organizational chart and key personnel information
- List of current challenges and growth objectives

INVESTMENT:
- Initial consultation: FREE
- Comprehensive audit: $2,500 - $5,000
- Full strategic engagement: Custom pricing based on scope
- Ongoing support: $1,500 - $3,000 per month

Our success is measured by your success. We\'re committed to delivering measurable results and long-term value for your business.'
        ]);

        // Personal Services Page (for option2)
        ContentPage::create([
            'slug' => 'page2',
            'title' => 'Personal Development & Individual Coaching',
            'description' => 'Transform your personal and professional life with our personalized coaching and development programs. We believe that every individual has unique potential waiting to be unlocked, and our role is to guide you on that journey.

Our certified coaches specialize in personal transformation, career advancement, life transitions, and goal achievement. Whether you\'re looking to advance your career, improve your leadership skills, achieve better work-life balance, or make a significant life change, we provide the support and tools you need.

We take a holistic approach to personal development, addressing not just professional goals but also personal well-being, relationships, and life satisfaction. Our programs are tailored to your specific needs, learning style, and life circumstances.',
            'instructions' => 'YOUR PERSONAL DEVELOPMENT JOURNEY:

1. DISCOVERY SESSION (60 minutes - FREE)
   - Comprehensive life and career assessment
   - Identify your core values, strengths, and aspirations
   - Discuss challenges and obstacles you\'re facing
   - Explore your vision for the future

2. PERSONALIZED COACHING PLAN (Week 1)
   - Custom development plan based on your goals
   - Selection of appropriate coaching methodologies
   - Setting of measurable milestones and timelines
   - Introduction to your dedicated personal coach

3. REGULAR COACHING SESSIONS (Ongoing)
   - Weekly 1-hour one-on-one coaching sessions
   - Progress tracking and accountability check-ins
   - Skill-building exercises and practical assignments
   - Access to our personal development resource library

4. SKILL DEVELOPMENT WORKSHOPS (Monthly)
   - Group workshops on leadership, communication, and productivity
   - Networking opportunities with other clients
   - Guest expert sessions on specialized topics
   - Peer learning and support groups

5. LIFE DESIGN & GOAL ACHIEVEMENT (Quarterly)
   - Quarterly strategic planning sessions
   - Vision board creation and life mapping exercises
   - Goal refinement and course correction as needed
   - Celebration of achievements and milestones

COACHING SPECIALTIES:
- Career Transition and Advancement
- Leadership Development
- Work-Life Balance and Wellness
- Relationship and Communication Skills
- Financial Planning and Money Mindset
- Creativity and Innovation Development

WHAT TO EXPECT:
- Complete confidentiality and non-judgmental support
- Practical tools and strategies you can implement immediately
- Accountability and motivation to stay on track
- A supportive community of like-minded individuals

INVESTMENT OPTIONS:
- Initial discovery session: FREE
- Single coaching session: $150
- Monthly coaching package (4 sessions): $500
- Quarterly intensive program: $1,200
- Annual transformation program: $4,000

GETTING STARTED:
- Complete our online assessment questionnaire
- Schedule your free discovery session
- Commit to showing up authentically for yourself
- Be open to growth and positive change

Remember: The best investment you can make is in yourself. Your future self will thank you for taking this important step today.'
        ]);
    }
}
