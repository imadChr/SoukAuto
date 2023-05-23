"""
Main driver file.
Handling user input.
Displaying current GameStatus object.
"""
import pygame as p
import ChessEngine, ChessAI
import sys
from multiprocessing import Process, Queue
import os
import os
os.chdir('C:/Users/Sifou/Documents/2ndYear/AI/AI-PROJECT/Chess-Game')
print(os.getcwd())

BOARD_WIDTH = BOARD_HEIGHT = 512
MOVE_LOG_PANEL_WIDTH = 250
MOVE_LOG_PANEL_HEIGHT = BOARD_HEIGHT
DIMENSION = 8
SQUARE_SIZE = BOARD_HEIGHT // DIMENSION
MAX_FPS = 15
IMAGES = {}

# Algorithms
HCALGO = 0
GALGO = 1
MMWABP = 2
HUMAN = 3
# Constants for the menu screen
WIDTH = BOARD_WIDTH + MOVE_LOG_PANEL_WIDTH
HEIGHT = BOARD_HEIGHT

def loadImages():
    """
    Initialize a global directory of images.
    This will be called exactly once in the main.
    """
    pieces = ['wp', 'wR', 'wN', 'wB', 'wK', 'wQ', 'bp', 'bR', 'bN', 'bB', 'bK', 'bQ']
    for piece in pieces:
        IMAGES[piece] = p.transform.scale(p.image.load("images/"+piece+".png"), (SQUARE_SIZE, SQUARE_SIZE))

def main():
    """
    The main driver for our code.
    This will handle user input and updating the graphics.
    """
    p.init()
    screen = p.display.set_mode((BOARD_WIDTH + MOVE_LOG_PANEL_WIDTH, BOARD_HEIGHT))
    clock = p.time.Clock()
    screen.fill(p.Color("white"))
    game_state = ChessEngine.GameState()
    valid_moves = game_state.getValidMoves()
    move_made = False  # flag variable for when a move is made
    animate = False  # flag variable for when we should animate a move
    loadImages()  # do this only once before while loop
    running = True
    square_selected = ()  # no square is selected initially, this will keep track of the last click of the user (tuple(row,col))
    player_clicks = []  # this will keep track of player clicks (two tuples)
    game_over = False
    ai_thinking = False
    move_undone = False
    move_finder_process = None
    move_log_font = p.font.SysFont("Arial", 14, False, False)
    MENU_FONT = p.font.SysFont("Arial", 24, False, False)
    MENU_TITLE_FONT = p.font.SysFont("Arial", 36, False, False)


    player_one = True  # if a human is playing white, then this will be True, else False
    player_two = False  # if a hyman is playing white, then this will be True, else False

    in_menu = True
    in_2nd_menu = False
    in_game = False
    algo = None
    algo2 = None
    while running:
        human_turn = (game_state.white_to_move and player_one) or (not game_state.white_to_move and player_two)
        for e in p.event.get():
            if e.type == p.QUIT:
                p.quit()
                sys.exit()
            # mouse handler
            elif e.type == p.MOUSEBUTTONDOWN:
                if in_menu:
                    mouse_pos = p.mouse.get_pos()
                    if WIDTH // 2 - 75 <= mouse_pos[0] <= WIDTH // 2 + 75:
                        if HEIGHT // 2 <= mouse_pos[1] <= HEIGHT // 2 + 30:
                            in_menu, in_2nd_menu, in_game, algo2 = handle_menu_click(1)
                        elif HEIGHT // 2 + 50 <= mouse_pos[1] <= HEIGHT // 2 + 80:
                            in_menu, in_2nd_menu, in_game, algo2 = handle_menu_click(2)
                        elif HEIGHT // 2 + 50 <= mouse_pos[1] <= HEIGHT // 2 + 130:
                            in_menu, in_2nd_menu, in_game, algo2 = handle_menu_click(3)
                        elif HEIGHT // 2 + 50 <= mouse_pos[1] <= HEIGHT // 2 + 180:
                            in_menu, in_2nd_menu, in_game, algo2 = handle_menu_click(4)
                        elif HEIGHT // 2 + 50 <= mouse_pos[1] <= HEIGHT // 2 + 230:
                            in_menu, in_2nd_menu, in_game, algo2 = handle_menu_click(5)
                elif in_2nd_menu:
                    mouse_pos = p.mouse.get_pos()
                    if WIDTH // 2 - 75 <= mouse_pos[0] <= WIDTH // 2 + 75:
                        if HEIGHT // 2 <= mouse_pos[1] <= HEIGHT // 2 + 30:
                            in_menu, in_game, in_2nd_menu, algo = handle_menu_click(1)
                        elif HEIGHT // 2 + 50 <= mouse_pos[1] <= HEIGHT // 2 + 80:
                            in_menu, in_game, in_2nd_menu, algo = handle_menu_click(2)
                        elif HEIGHT // 2 + 50 <= mouse_pos[1] <= HEIGHT // 2 + 130:
                            in_menu, in_game, in_2nd_menu, algo = handle_menu_click(3)
                        elif HEIGHT // 2 + 50 <= mouse_pos[1] <= HEIGHT // 2 + 180:
                            in_menu, in_game, in_2nd_menu, algo = handle_menu_click(5)
                elif not game_over and in_game:
                    location = p.mouse.get_pos()  # (x, y) location of the mouse
                    col = location[0] // SQUARE_SIZE
                    row = location[1] // SQUARE_SIZE
                    if square_selected == (row, col) or col >= 8:  # user clicked the same square twice
                        square_selected = ()  # deselect
                        player_clicks = []  # clear clicks
                    else:
                        square_selected = (row, col)
                        player_clicks.append(square_selected)  # append for both 1st and 2nd click
                    if len(player_clicks) == 2 and human_turn:  # after 2nd click
                        move = ChessEngine.Move(player_clicks[0], player_clicks[1], game_state.board)
                        for i in range(len(valid_moves)):
                            if move == valid_moves[i]:
                                game_state.makeMove(valid_moves[i])
                                move_made = True
                                animate = True
                                square_selected = ()  # reset user clicks
                                player_clicks = []
                        if not move_made:
                            player_clicks = [square_selected]

            # key handler
            elif e.type == p.KEYDOWN:
                if in_menu:
                    if e.key == p.K_1:
                        in_menu = False
                        in_2nd_menu = True
                        in_game = False
                        algo2 = HCALGO
                    elif e.key == p.K_2:
                        in_menu = False
                        in_2nd_menu = True
                        in_game = False
                        algo2 = GALGO
                    elif e.key == p.K_3:
                        in_menu = False
                        in_2nd_menu = True
                        in_game = False
                        algo2 = MMWABP
                    elif e.key == p.K_4: 
                        in_menu = False
                        in_2nd_menu = True
                        in_game = False
                        algo2 = HUMAN
                    elif e.key == p.K_5:  # Quit
                        p.quit()
                        sys.exit()
                elif in_2nd_menu:
                    if e.key == p.K_1:
                        in_menu = False
                        in_2nd_menu = False
                        in_game = True
                        algo = HCALGO
                    elif e.key == p.K_2:
                        in_menu = False
                        in_2nd_menu = False
                        in_game = True
                        algo = GALGO
                    elif e.key == p.K_3:
                        in_menu = False
                        in_2nd_menu = False
                        in_game = True
                        algo = MMWABP
                    elif e.key == p.K_4:  # Quit
                        p.quit()
                        sys.exit()
                elif in_game:
                    if e.key == p.K_z:  # undo when 'z' is pressed
                        game_state.undoMove()
                        move_made = True
                        animate = False
                        game_over = False
                        if ai_thinking:
                            move_finder_process.terminate()
                            ai_thinking = False
                        move_undone = True
                if e.key == p.K_r:
                    main()  # reset the game when 'r' is pressed
                    # game_state = ChessEngine.GameState()
                    # valid_moves = game_state.getValidMoves()
                    # square_selected = ()
                    # player_clicks = []
                    # move_made = False
                    # animate = False
                    # game_over = False
                    # if ai_thinking:
                    #     move_finder_process.terminate()
                    #     ai_thinking = False
                    # move_undone = True
                    # in_menu = True
                    # in_game = False
                    

        # AI move finder
        if in_game and not game_over and not human_turn and not move_undone:
            if algo == HCALGO:
                ai_move = ChessAI.find_best_move_hill_climbing(game_state, valid_moves)
                if ai_move is None:
                    ai_move = ChessAI.findRandomMove(valid_moves)
                game_state.makeMove(ai_move)
                move_made = True
                animate = True
                ai_thinking = False
            elif algo == GALGO:
                ai_move = ChessAI.find_best_move_genetic_algo(game_state, valid_moves)
                if ai_move is None:
                    ai_move = ChessAI.findRandomMove(valid_moves)
                game_state.makeMove(ai_move)
                move_made = True
                animate = True
                ai_thinking = False
            elif algo == MMWABP:
                if not ai_thinking:
                    ai_thinking = True
                    return_queue = Queue()  # used to pass data between threads
                    move_finder_process = Process(target=ChessAI.find_best_move_minimax, args=(game_state, valid_moves, return_queue))
                    move_finder_process.start()

                if not move_finder_process.is_alive():
                    ai_move = return_queue.get()
                    if ai_move is None:
                        ai_move = ChessAI.findRandomMove(valid_moves)
                    game_state.makeMove(ai_move)
                    move_made = True
                    animate = True
                    ai_thinking = False
        elif in_game and not game_over and human_turn:
            if algo2 == HCALGO:
                ai_move = ChessAI.find_best_move_hill_climbing(game_state, valid_moves)
                if ai_move is None:
                    ai_move = ChessAI.findRandomMove(valid_moves)
                game_state.makeMove(ai_move)
                move_made = True
                animate = True
                ai_thinking = False
            elif algo2 == GALGO:
                ai_move = ChessAI.find_best_move_genetic_algo(game_state, valid_moves)
                if ai_move is None:
                    ai_move = ChessAI.findRandomMove(valid_moves)
                game_state.makeMove(ai_move)
                move_made = True
                animate = True
                ai_thinking = False
            elif algo2 == MMWABP:
                if not ai_thinking:
                    ai_thinking = True
                    return_queue = Queue()  # used to pass data between threads
                    move_finder_process = Process(target=ChessAI.find_best_move_minimax, args=(game_state, valid_moves, return_queue))
                    move_finder_process.start()

                if not move_finder_process.is_alive():
                    ai_move = return_queue.get()
                    if ai_move is None:
                        ai_move = ChessAI.findRandomMove(valid_moves)
                    game_state.makeMove(ai_move)
                    move_made = True
                    animate = True
                    ai_thinking = False

        if move_made:
            if animate:
                animateMove(game_state.move_log[-1], screen, game_state.board, clock)
            valid_moves = game_state.getValidMoves()
            move_made = False
            animate = False
            move_undone = False
        if in_menu:
            draw_menu(screen, MENU_TITLE_FONT, MENU_FONT)
        elif in_2nd_menu:
            draw_2nd_menu(screen, MENU_TITLE_FONT, MENU_FONT)
        elif in_game:
            drawGameState(screen, game_state, valid_moves, square_selected)

            if not game_over:
                drawMoveLog(screen, game_state, move_log_font)

            if game_state.checkmate:
                game_over = True
                if game_state.white_to_move:
                    drawEndGameText(screen, "Black wins by checkmate")
                else:
                    drawEndGameText(screen, "White wins by checkmate")

            elif game_state.stalemate:
                game_over = True
                drawEndGameText(screen, "Stalemate")

            clock.tick(MAX_FPS)
            p.display.flip()


def drawGameState(screen, game_state, valid_moves, square_selected):
    """
    Responsible for all the graphics within current game state.
    """
    drawBoard(screen)  # draw squares on the board
    highlightSquares(screen, game_state, valid_moves, square_selected)
    drawPieces(screen, game_state.board)  # draw pieces on top of those squares


def drawBoard(screen):
    """
    Draw the squares on the board.
    The top left square is always light.
    """
    global colors
    colors = [p.Color("white"), p.Color("gray")]
    for row in range(DIMENSION):
        for column in range(DIMENSION):
            color = colors[((row + column) % 2)]
            p.draw.rect(screen, color, p.Rect(column * SQUARE_SIZE, row * SQUARE_SIZE, SQUARE_SIZE, SQUARE_SIZE))


def highlightSquares(screen, game_state, valid_moves, square_selected):
    """
    Highlight square selected and moves for piece selected.
    """
    if (len(game_state.move_log)) > 0:
        last_move = game_state.move_log[-1]
        s = p.Surface((SQUARE_SIZE, SQUARE_SIZE))
        s.set_alpha(100)
        s.fill(p.Color('green'))
        screen.blit(s, (last_move.end_col * SQUARE_SIZE, last_move.end_row * SQUARE_SIZE))
    if square_selected != ():
        row, col = square_selected
        if game_state.board[row][col][0] == (
                'w' if game_state.white_to_move else 'b'):  # square_selected is a piece that can be moved
            # highlight selected square
            s = p.Surface((SQUARE_SIZE, SQUARE_SIZE))
            s.set_alpha(100)  # transparency value 0 -> transparent, 255 -> opaque
            s.fill(p.Color('blue'))
            screen.blit(s, (col * SQUARE_SIZE, row * SQUARE_SIZE))
            # highlight moves from that square
            s.fill(p.Color('yellow'))
            for move in valid_moves:
                if move.start_row == row and move.start_col == col:
                    screen.blit(s, (move.end_col * SQUARE_SIZE, move.end_row * SQUARE_SIZE))


def drawPieces(screen, board):
    """
    Draw the pieces on the board using the current game_state.board
    """
    for row in range(DIMENSION):
        for column in range(DIMENSION):
            piece = board[row][column]
            if piece != "--":
                screen.blit(IMAGES[piece], p.Rect(column * SQUARE_SIZE, row * SQUARE_SIZE, SQUARE_SIZE, SQUARE_SIZE))


def drawMoveLog(screen, game_state, font):
    """
    Draws the move log.

    """
    move_log_rect = p.Rect(BOARD_WIDTH, 0, MOVE_LOG_PANEL_WIDTH, MOVE_LOG_PANEL_HEIGHT)
    p.draw.rect(screen, p.Color('black'), move_log_rect)
    move_log = game_state.move_log
    move_texts = []
    for i in range(0, len(move_log), 2):
        move_string = str(i // 2 + 1) + '. ' + str(move_log[i]) + " "
        if i + 1 < len(move_log):
            move_string += str(move_log[i + 1]) + "  "
        move_texts.append(move_string)

    moves_per_row = 3
    padding = 5
    line_spacing = 2
    text_y = padding
    for i in range(0, len(move_texts), moves_per_row):
        text = ""
        for j in range(moves_per_row):
            if i + j < len(move_texts):
                text += move_texts[i + j]

        text_object = font.render(text, True, p.Color('white'))
        text_location = move_log_rect.move(padding, text_y)
        screen.blit(text_object, text_location)
        text_y += text_object.get_height() + line_spacing


def drawEndGameText(screen, text):
    font = p.font.SysFont("Helvetica", 32, True, False)
    text_object = font.render(text, False, p.Color("gray"))
    text_location = p.Rect(0, 0, BOARD_WIDTH, BOARD_HEIGHT).move(BOARD_WIDTH / 2 - text_object.get_width() / 2,
                                                                 BOARD_HEIGHT / 2 - text_object.get_height() / 2)
    screen.blit(text_object, text_location)
    text_object = font.render(text, False, p.Color('black'))
    screen.blit(text_object, text_location.move(2, 2))


def animateMove(move, screen, board, clock):
    """
    Animating a move
    """
    global colors
    d_row = move.end_row - move.start_row
    d_col = move.end_col - move.start_col
    frames_per_square = 10  # frames to move one square
    frame_count = (abs(d_row) + abs(d_col)) * frames_per_square
    for frame in range(frame_count + 1):
        row, col = (move.start_row + d_row * frame / frame_count, move.start_col + d_col * frame / frame_count)
        drawBoard(screen)
        drawPieces(screen, board)
        # erase the piece moved from its ending square
        color = colors[(move.end_row + move.end_col) % 2]
        end_square = p.Rect(move.end_col * SQUARE_SIZE, move.end_row * SQUARE_SIZE, SQUARE_SIZE, SQUARE_SIZE)
        p.draw.rect(screen, color, end_square)
        # draw captured piece onto rectangle
        if move.piece_captured != '--':
            if move.is_enpassant_move:
                enpassant_row = move.end_row + 1 if move.piece_captured[0] == 'b' else move.end_row - 1
                end_square = p.Rect(move.end_col * SQUARE_SIZE, enpassant_row * SQUARE_SIZE, SQUARE_SIZE, SQUARE_SIZE)
            screen.blit(IMAGES[move.piece_captured], end_square)
        # draw moving piece
        screen.blit(IMAGES[move.piece_moved], p.Rect(col * SQUARE_SIZE, row * SQUARE_SIZE, SQUARE_SIZE, SQUARE_SIZE))
        p.display.flip()
        clock.tick(60)


def draw_menu(screen, menu_title_font, menu_font):
    screen.fill(p.Color("white"))
    title_text = menu_title_font.render("Chess Game - 1st player - White", True, p.Color("black"))
    screen.blit(title_text, (WIDTH // 2 - title_text.get_width() // 2, BOARD_HEIGHT // 4))
    option1_text = menu_font.render("1. Hill Climbing Algorithm", True, p.Color("black"))
    option2_text = menu_font.render("2. Genetic Algorithm", True, p.Color("black"))
    option3_text = menu_font.render("3. Mini-max with Alpha-Beta pruning", True, p.Color("black"))
    option4_text = menu_font.render("4. Human", True, p.Color("black"))
    option5_text = menu_font.render("5. Quit", True, p.Color("black"))
    screen.blit(option1_text, (WIDTH // 2 - option1_text.get_width() // 2, BOARD_HEIGHT // 2))
    screen.blit(option2_text, (WIDTH // 2 - option2_text.get_width() // 2, BOARD_HEIGHT // 2 + 50))
    screen.blit(option3_text, (WIDTH // 2 - option3_text.get_width() // 2, BOARD_HEIGHT // 2 + 100))
    screen.blit(option4_text, (WIDTH // 2 - option4_text.get_width() // 2, BOARD_HEIGHT // 2 + 150))
    screen.blit(option5_text, (WIDTH // 2 - option5_text.get_width() // 2, BOARD_HEIGHT // 2 + 200))
    p.display.flip()

def draw_2nd_menu(screen, menu_title_font, menu_font):
    screen.fill(p.Color("white"))
    title_text = menu_title_font.render("Chess Game - 2nd player - Black", True, p.Color("black"))
    screen.blit(title_text, (WIDTH // 2 - title_text.get_width() // 2, BOARD_HEIGHT // 4))
    option1_text = menu_font.render("1. Hill Climbing Algorithm", True, p.Color("black"))
    option2_text = menu_font.render("2. Genetic Algorithm", True, p.Color("black"))
    option3_text = menu_font.render("3. Mini-max with Alpha-Beta pruning", True, p.Color("black"))
    option4_text = menu_font.render("4. Quit", True, p.Color("black"))
    screen.blit(option1_text, (WIDTH // 2 - option1_text.get_width() // 2, BOARD_HEIGHT // 2))
    screen.blit(option2_text, (WIDTH // 2 - option2_text.get_width() // 2, BOARD_HEIGHT // 2 + 50))
    screen.blit(option3_text, (WIDTH // 2 - option3_text.get_width() // 2, BOARD_HEIGHT // 2 + 100))
    screen.blit(option4_text, (WIDTH // 2 - option4_text.get_width() // 2, BOARD_HEIGHT // 2 + 150))
    p.display.flip()


def handle_menu_click(option):
    if option == 1:  # HCALGO
        return False, True, False, HCALGO
    elif option == 2:  # GALGO
        return False, True, False, GALGO
    elif option == 3:  # MMWABP
        return False, True, False, MMWABP
    elif option == 4:  # HUMAN
        return False, True, False, HUMAN
    elif option == 5:  # QUIT
        p.quit()
        sys.exit()
        return False, False, None
    else:
        return True, False, None

if __name__ == "__main__":
    main()
