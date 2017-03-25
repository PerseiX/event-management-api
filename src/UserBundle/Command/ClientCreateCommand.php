<?php

namespace UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ClientCreateCommand
 * @package UserBundle\Command
 */
class ClientCreateCommand extends ContainerAwareCommand
{
	/**
	 * {@inheritdoc}
	 */
	protected function configure()
	{
		$this->setName('event-management:client:create')
		     ->setDescription("Command allow you crete OAuth2 client.")
		     ->setHelp("Use command with parameters: allowedGrantType clientName redirectUris")
		     ->addArgument('allowedGrantType', InputArgument::REQUIRED, 'Allowed grant types [authorization_code, refresh_token]')
		     ->addArgument('clientName', InputArgument::REQUIRED, 'Client name')
		     ->addArgument('redirectUris', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'Redirect uris');
	}

	/**
	 * @param InputInterface  $input
	 * @param OutputInterface $output
	 *
	 * {@inheritdoc}
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$redirectUris     = $input->getArgument('redirectUris');
		$allowedGrantType = $input->getArgument('allowedGrantType');
		$clientName       = $input->getArgument('clientName');

		$clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
		$client        = $clientManager->createClient();
		$client->setRedirectUris($redirectUris);
		$client->setAllowedGrantTypes([$allowedGrantType]);
		$client->setName($clientName);
		$clientManager->updateClient($client);

		$output->writeln(sprintf("Added client with id: %s secret: %s", $client->getPublicId(), $client->getSecret()));
	}

}