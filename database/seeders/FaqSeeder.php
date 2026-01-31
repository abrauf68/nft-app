<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How do I register an account?',
                'answer'   => 'Click on the Sign Up button on the homepage and fill in your details to register.',
            ],
            [
                'question' => 'How do I earn referral rewards?',
                'answer'   => 'Invite your friends using your referral link or code. When they verify their email and participate, you earn rewards.',
            ],
            [
                'question' => 'How do I deposit money?',
                'answer'   => 'Go to your wallet, click on Add Money, select the amount and crypto type, then confirm the transaction.',
            ],
            [
                'question' => 'Can I withdraw my earnings?',
                'answer'   => 'Yes, you can withdraw your available balance from your wallet by selecting Withdrawal and following the instructions.',
            ],
            [
                'question' => 'What are the supported cryptocurrencies?',
                'answer'   => 'We currently support USDT (TRC20), Bitcoin (BTC), and Ethereum (ETH) for deposits and withdrawals.',
            ],
            [
                'question' => 'How do I claim a reward?',
                'answer'   => 'Go to the Rewards section, click Claim on the available reward, and the amount will be credited to your wallet.',
            ],
            [
                'question' => 'What should I do if my transaction fails?',
                'answer'   => 'Contact our support team with your transaction ID, and we will help resolve the issue.',
            ],
            [
                'question' => 'Is my personal data secure?',
                'answer'   => 'Yes, we use advanced security measures to ensure your personal and financial information is safe.',
            ],
            [
                'question' => 'How can I contact support?',
                'answer'   => 'You can contact our support team via the Contact Us page or by emailing support@nft.com.',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
